<script setup lang="ts">
import { useRoute } from '@/composables/useRoute';
import { useRouteParams } from '@/composables/useRouteParams';
import { pagePropsInject } from '@/injection-keys';
import HtButton from '@/Reusable/HtButton.vue';
import HtCard from '@/Reusable/HtCard.vue';
import HtCode from '@/Reusable/HtCode.vue';
import HtColorInput from '@/Reusable/HtColorInput.vue';
import HtExternalLink from '@/Reusable/HtExternalLink.vue';
import HtFormControlSettings from '@/Reusable/HtFormControlSettings.vue';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtInput from '@/Reusable/HtInput.vue';
import HtInputGropupText from '@/Reusable/HtInputGropupText.vue';
import HtLinkButton from '@/Reusable/HtLinkButton.vue';
import HtTable from '@/Reusable/HtTable.vue';
import HtTranslate from '@/Reusable/HtTranslate.vue';
import { getAppName } from '@/utils/app';
import { safeRoute } from '@/utils/safe-route';
import { faFileExport, faLink } from '@fortawesome/free-solid-svg-icons';
import { inject, onMounted, ref } from 'vue';

interface NumberCssVar {
  value: number;
  type: 'number';
  step?: number;
  negative?: boolean;
  unit: string;
}

interface StringCssVar {
  value: string;
  type: 'text';
}

interface ColorCssVar {
  value: string;
  type: 'color';
}

interface ColorVariant {
  name: string;
  value: string;
}

interface ColorPairCssVar {
  type: 'color-pair';
  name: string;
  displayName: string;
  light: ColorVariant;
  dark: ColorVariant;
}

type CssVar = StringCssVar | NumberCssVar | ColorCssVar;
type NamedCssVar = CssVar & { name: string, displayName: string };
type EditorCssVar = NamedCssVar | ColorPairCssVar;

const route = useRoute();
const pageProps = inject(pagePropsInject);
const routeParams = useRouteParams(route, pageProps);

const cssVars = ref<EditorCssVar[]>([]);

const varNamePrefix = '--ht-';

const getCssVarDisplayName = (cssVar: string) =>
  cssVar
    .replace(varNamePrefix, '')
    .replace(/-bg-/g, '-background-')
    .replace(/-hl-/g, '-highlight-')
    .replace(/-cta-/g, '-call-to-action-')
    .replace(/^([a-z]+)-(.*)(-(?:light|dark))$/, '$2-$1$3')
    .replace(/(color)-color/g, '$1')
    .replace(/^value-/, '')
    .replace(/-+/g, ' ')
    .replace(/((?:^| )[a-z])/g, (m) => m.toUpperCase());

const getColorPairDisplayName = (baseName: string) =>
  getCssVarDisplayName(baseName + '-light')
    .replace(/ Color Light$/, '')
    .replace(/ Light$/, '');

const parseCssValue = (value: string, name: string): CssVar => {
  if (value.endsWith('rem')) return {
    type: 'number',
    step: 0.0625,
    unit: 'rem',
    value: parseFloat(value),
  };
  if (value.endsWith('em')) return {
    type: 'number',
    step: 0.0625,
    unit: 'em',
    value: parseFloat(value),
  };
  if (value.endsWith('ms')) return {
    type: 'number',
    step: 50,
    unit: 'ms',
    value: parseFloat(value),
  };
  if (value.endsWith('s')) return {
    type: 'number',
    step: 0.1,
    unit: 's',
    value: parseFloat(value),
  };
  if (value.endsWith('%')) return { type: 'number', step: 1, unit: '%', value: parseFloat(value) };
  if (value.endsWith('deg')) return {
    type: 'number',
    step: 1,
    unit: 'deg',
    value: parseFloat(value),
  };
  if (value.endsWith('px')) return {
    type: 'number',
    step: 1,
    unit: 'px',
    value: parseFloat(value),
  };
  if (!isNaN(parseFloat(value))) return {
    type: 'number',
    step: name.includes('z-index') ? 1 : 0.05,
    unit: '',
    value: parseFloat(value),
  };
  if (/^#[\da-f]{3}$/i.test(value)) {
    // Expand 3-char hex for native color picker compatibility
    return { type: 'color', value: '#' + value[1].repeat(2) + value[2].repeat(2) + value[3].repeat(2) };
  }
  if (/^#[\da-f]{6}$/i.test(value)) return { type: 'color', value };
  if (value === 'transparent') return { type: 'color', value };
  if (/^rgba?\(/.test(value)) return { type: 'color', value };
  if (/^hsla?\(/.test(value)) return { type: 'color', value };

  return { type: 'text', value }; // Default fallback
};

const exportUserStyle = () => {
  let userStyle = `
/* ${getAppName()} Custom UserStyle */
@-moz-document url-prefix("${route('root')}") {
  :root {
`;

  cssVars.value.forEach(cssVar => {
    if (cssVar.type === 'color-pair') {
      userStyle += `    ${cssVar.light.name}: ${cssVar.light.value};\n`;
      userStyle += `    ${cssVar.dark.name}: ${cssVar.dark.value};\n`;
    } else {
      userStyle += `    ${cssVar.name}: ${cssVar.value}${'unit' in cssVar ? cssVar.unit : ''};\n`;
    }
  });

  userStyle += `  }
}`;

  const blob = new Blob([userStyle], { type: 'text/css' });
  const link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = `${getAppName().toLowerCase().replace(/[^a-z]+/g, '-')}.user.css`;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
};

const updateVariable = (name: string, value: string | number, unit: string = ''): void => {
  document.documentElement.style.setProperty(name, `${value}${unit}`);
};

onMounted(() => {
  const styles = getComputedStyle(document.documentElement);
  const allVarMap = new Map<string, NamedCssVar>();

  for (let i = 0; i < styles.length; i++) {
    const varName = styles[i];
    if (varName && varName.startsWith(varNamePrefix)) {
      const value = styles.getPropertyValue(varName).trim();
      const parsed = parseCssValue(value, varName);
      if (parsed.type === 'number') {
        parsed.negative = parsed.value < 0;
      }
      allVarMap.set(varName, {
        ...parsed,
        name: varName,
        displayName: getCssVarDisplayName(varName),
      });
    }
  }

  const pairedNames = new Set<string>();
  const result: EditorCssVar[] = [];

  for (const [name, cssVar] of allVarMap) {
    if (cssVar.type === 'color' && name.endsWith('-light')) {
      const base = name.slice(0, -6);
      const darkName = base + '-dark';
      const darkVar = allVarMap.get(darkName);
      if (darkVar?.type === 'color') {
        pairedNames.add(name);
        pairedNames.add(darkName);
        pairedNames.add(base);
        result.push({
          type: 'color-pair',
          name: base,
          displayName: getColorPairDisplayName(base),
          light: { name, value: cssVar.value },
          dark: { name: darkName, value: darkVar.value },
        });
      }
    }
  }

  for (const [name, cssVar] of allVarMap) {
    if (!pairedNames.has(name)) {
      result.push(cssVar);
    }
  }

  cssVars.value = result.sort((a, b) => a.displayName.localeCompare(b.displayName));
});
</script>

<template>
  <HtCard class="design-editor">
    <template #header>
      <h2>{{ $t('global.designEditor.title') }}</h2>
    </template>

    <p class="mb-3">
      {{ $t('global.designEditor.description') }}
    </p>

    <HtLinkButton
      color="primary"
      :icon-start="faLink"
      :href="safeRoute('design', route, {routeParams})"
      :external="false"
    >
      {{ $t('global.designEditor.designPageLink') }}
    </HtLinkButton>

    <p class="mt-3 mb-3">
      <HtTranslate i18n-key="global.designEditor.exportInfo">
        <template #1="slotProps">
          <HtExternalLink href="https://github.com/openstyles/stylus">
            {{ slotProps.text }}
          </HtExternalLink>
        </template>
      </HtTranslate>
    </p>

    <HtButton
      color="primary"
      :icon-start="faFileExport"
      @click="exportUserStyle"
    >
      {{ $t('global.designEditor.export') }}
    </HtButton>

    <HtTable
      class="design-editor-table mt-3"
      :responsive="true"
    >
      <thead>
        <tr>
          <th>{{ $t('global.designEditor.variableColumnHeader') }}</th>
          <th>{{ $t('global.designEditor.valueColumnHeader') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="cssVar in cssVars"
          :key="cssVar.name"
        >
          <td>
            <label :for="cssVar.type !== 'color-pair' ? cssVar.name : undefined">
              {{ cssVar.displayName }}
            </label>
            <br>
            <HtCode :small="true">
              {{ cssVar.name }}
            </HtCode>
          </td>
          <td>
            <template v-if="cssVar.type === 'color-pair'">
              <div class="color-pair-inputs">
                <div
                  v-for="variant in [
                    { label: $t('global.sidebar.themeButton.light'), data: cssVar.light },
                    { label: $t('global.sidebar.themeButton.dark'), data: cssVar.dark },
                  ]"
                  :key="variant.data.name"
                  class="color-pair-variant"
                >
                  <label :for="variant.data.name">{{ variant.label }}</label>
                  <HtColorInput
                    :id="variant.data.name"
                    :model-value="variant.data.value"
                    @update:model-value="(v) => { variant.data.value = v; updateVariable(variant.data.name, v); }"
                  />
                </div>
              </div>
            </template>
            <HtColorInput
              v-else-if="cssVar.type === 'color'"
              :id="cssVar.name"
              :model-value="cssVar.value"
              @update:model-value="(v) => { cssVar.value = v; updateVariable(cssVar.name, v); }"
            />
            <HtFormInputGroup
              v-else-if="cssVar.type === 'number'"
              :id="cssVar.name"
              dir="ltr"
            >
              <HtFormControlSettings>
                <HtInput
                  v-model="cssVar.value"
                  type="number"
                  :step="cssVar.step"
                  :min="cssVar.negative ? undefined : 0"
                  :max="cssVar.negative ? 0 : undefined"
                  @input="updateVariable(cssVar.name, cssVar.value, cssVar.unit)"
                />
                <HtInputGropupText v-if="'unit' in cssVar && cssVar.unit.length > 0">
                  {{ cssVar.unit }}
                </HtInputGropupText>
              </HtFormControlSettings>
            </HtFormInputGroup>
            <HtFormControlSettings
              v-else
              :id="cssVar.name"
              :full-width="true"
            >
              <HtInput
                v-model="cssVar.value"
                type="text"
                @input="updateVariable(cssVar.name, cssVar.value)"
              />
            </HtFormControlSettings>
          </td>
        </tr>
      </tbody>
    </HtTable>
  </HtCard>
</template>
