// @ts-check

import eslint from '@eslint/js';
import tseslint from 'typescript-eslint';
import pluginVue from 'eslint-plugin-vue';

export default tseslint.config(
  eslint.configs.recommended,
  ...tseslint.configs.recommended,
  ...pluginVue.configs['flat/recommended'],
  {
    files: ['**/*.{ts,tsx,mts,cts,vue}'],
    rules: {
      'no-undef': 'off',
      '@typescript-eslint/no-restricted-imports': ['error', {
        paths: [{
          name: 'ziggy-js',
          importNames: ['useRoute', 'route'],
          allowTypeImports: true,
          message: 'Use @/composables/useRoute instead; ziggy-js reads `document` and breaks SSR.',
        }],
      }],
    },
  },
  {
    plugins: {
      'typescript-eslint': tseslint.plugin,
    },
    languageOptions: {
      parserOptions: {
        parser: tseslint.parser,
        project: './tsconfig.json',
        extraFileExtensions: ['.vue'],
        sourceType: 'module',
      },
    },
  },
  {
    files: ['resources/js/Components/home/FaqCard.vue'],
    rules: {
      'vue/no-v-html': 'off',
    }
  },
);
