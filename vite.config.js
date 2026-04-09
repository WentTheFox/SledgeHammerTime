import { execSync } from 'child_process';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { resolve } from 'path';
import i18n from 'laravel-vue-i18n/vite';
import viteImagemin from '@wentthefox-forks/vite-plugin-imagemin';
import sharp from 'sharp';
import { Features } from 'lightningcss';
import { parse } from 'dotenv';

const tryExec = (cmd) => {
  try {
    return execSync(cmd).toString().trim();
  } catch (e) {
    console.warn(`tryExec failed: ${cmd}`, e);
    return null;
  }
};
const gitCommitHash = tryExec('git rev-parse --short HEAD');
const gitCommitDate = tryExec('git log -1 --format=%cI');

const imageminWebp = async buffer => {
  return await sharp(buffer)
    .webp({
      quality: 80,
      lossless: false,
    })
    .toBuffer()
    .catch((err) => {
      throw new Error('imagemin-webp', { cause: err });
    });
};
const imageminAvif = async buffer => {
  return await sharp(buffer)
    .avif({
      quality: 60,
      lossless: false,
      speed: 5,
      chromaSubsampling: '4:2:0',
    })
    .toBuffer()
    .catch((err) => {
      throw new Error('imagemin-avif', { cause: err });
    });
};

export default defineConfig(({ mode }) => {
  const isTest = process.env.NODE_ENV === 'test' || mode === 'test';

  const conditionalPlugins = [];
  if (!isTest) {
    conditionalPlugins.push(laravel({
      input: 'resources/js/app.ts',
      ssr: 'resources/js/ssr.ts',
      refresh: true,
      buildDirectory: process.env.VITE_BUILD_OUTDIR ?? 'build',
    }));
  }

  const env = parse('./.env');
  return ({
    define: {
      __GIT_COMMIT_HASH__: JSON.stringify(gitCommitHash),
      __GIT_COMMIT_DATE__: JSON.stringify(gitCommitDate),
    },
    server: {
      origin: env.APP_VITE_SERVER_ORIGIN,
      host: env.APP_VITE_SERVER_HOST || 'localhost',
      cors: env.APP_VITE_SERVER_CORS_ORIGIN ? {
        origin: env.APP_VITE_SERVER_CORS_ORIGIN,
      } : undefined,
    },
    resolve: {
      alias: {
        '~@picocss': resolve(__dirname, 'node_modules/@picocss'),
        '~the-new-css-reset': resolve(__dirname, 'node_modules/the-new-css-reset'),
        '~@fortawesome': resolve(__dirname, 'node_modules/@fortawesome'),
        '~tippy.js': resolve(__dirname, 'node_modules/tippy.js'),
        '@img': resolve(__dirname, 'resources/img'),
        '@public': resolve(__dirname, 'public'),
        '@': resolve(__dirname, 'resources/js'),
      },
    },
    plugins: [
      ...conditionalPlugins,
      vue(),
      i18n(),
      viteImagemin({
        skipIfLarger: false,
        plugins: {
          bypass: () => [],
        },
        makeWebp: {
          plugins: {
            png: imageminWebp,
          },
          skipIfLargerThan: false,
        },
        makeAvif: {
          plugins: {
            png: imageminAvif,
          },
          skipIfLargerThan: false,
        },
      }),
    ],
    build: {
      rollupOptions: {
        output: {
          manualChunks(id) {
            if (id.includes('.json')) {
              return id.split(/[\\\/]/g).find(el => el.includes('.json')).replace('.json', '-json');
            }

            return null;
          },
        },
      },
    },
    css: {
      lightningcss: {
        exclude: Features.LightDark,
      },
    },
    test: {
      sequence: {
        shuffle: true,
      },
      exclude: [
        '**/node_modules/**',
        '**/vendor/**',
      ],
      setupFiles: ['./setup/setup.ts'],
      coverage: {
        provider: 'v8',
        include: ['resources/js/**/*.ts'],
      },
    },
  });
});
