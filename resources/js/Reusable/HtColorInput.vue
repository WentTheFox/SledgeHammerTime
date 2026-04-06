<script setup lang="ts">
import HtFormControlGroup from '@/Reusable/HtFormControlGroup.vue';
import HtFormControlSettings from '@/Reusable/HtFormControlSettings.vue';
import HtFormInputGroup from '@/Reusable/HtFormInputGroup.vue';
import HtFormRadio from '@/Reusable/HtFormRadio.vue';
import HtInput from '@/Reusable/HtInput.vue';
import HtInputGropupText from '@/Reusable/HtInputGropupText.vue';
import { computed, ref, useId, watch } from 'vue';

type ColorFormat = 'hex' | 'rgb' | 'hsl';

// --- Color math utilities ---

function hexToRgb(hex: string): [number, number, number] {
  const digits = hex.replace('#', '').match(/.{2}/g)!;
  return digits.map(c => parseInt(c, 16)) as [number, number, number];
}

function rgbToHex(r: number, g: number, b: number): string {
  return '#' + [r, g, b].map(c => Math.round(c).toString(16).padStart(2, '0')).join('');
}

function rgbToHsl(r: number, g: number, b: number): [number, number, number] {
  const rn = r / 255, gn = g / 255, bn = b / 255;
  const max = Math.max(rn, gn, bn), min = Math.min(rn, gn, bn);
  const l = (max + min) / 2;
  if (max === min) return [0, 0, Math.round(l * 100)];
  const d = max - min;
  const s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
  const h = max === rn ? (gn - bn) / d + (gn < bn ? 6 : 0)
    : max === gn ? (bn - rn) / d + 2
      : (rn - gn) / d + 4;
  return [Math.round((h / 6) * 360), Math.round(s * 100), Math.round(l * 100)];
}

function hslToRgb(h: number, s: number, l: number): [number, number, number] {
  const hn = h / 360, sn = s / 100, ln = l / 100;
  if (sn === 0) {
    const v = Math.round(ln * 255);
    return [v, v, v];
  }
  const q = ln < 0.5 ? ln * (1 + sn) : ln + sn - ln * sn;
  const p = 2 * ln - q;
  const hue2rgb = (t: number) => {
    if (t < 0) t += 1;
    if (t > 1) t -= 1;
    if (t < 1 / 6) return p + (q - p) * 6 * t;
    if (t < 1 / 2) return q;
    if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
    return p;
  };
  return [
    Math.round(hue2rgb(hn + 1 / 3) * 255),
    Math.round(hue2rgb(hn) * 255),
    Math.round(hue2rgb(hn - 1 / 3) * 255),
  ];
}

// --- Parsing ---

interface ParsedColor {
  r: number;
  g: number;
  b: number;
  h: number;
  s: number;
  l: number;
  a: number;
  format: ColorFormat;
}

function parseColorValue(value: string): ParsedColor {
  if (value === 'transparent') {
    return { r: 0, g: 0, b: 0, h: 0, s: 0, l: 0, a: 0, format: 'hex' };
  }

  if (value.startsWith('#')) {
    let hex = value;
    if (/^#[\da-f]{3}$/i.test(hex)) {
      hex = '#' + hex[1].repeat(2) + hex[2].repeat(2) + hex[3].repeat(2);
    }
    const [r, g, b] = hexToRgb(hex);
    const [h, s, l] = rgbToHsl(r, g, b);
    return { r, g, b, h, s, l, a: 1, format: 'hex' };
  }

  const rgbaMatch = value.match(/^rgba?\(([\d.]+),\s*([\d.]+),\s*([\d.]+)(?:,\s*([\d.]+))?\)$/);
  if (rgbaMatch) {
    const r = Math.round(parseFloat(rgbaMatch[1]));
    const g = Math.round(parseFloat(rgbaMatch[2]));
    const b = Math.round(parseFloat(rgbaMatch[3]));
    const a = rgbaMatch[4] !== undefined ? parseFloat(rgbaMatch[4]) : 1;
    const [h, s, l] = rgbToHsl(r, g, b);
    return { r, g, b, h, s, l, a, format: 'rgb' };
  }

  const hslaMatch = value.match(/^hsla?\(([\d.]+),\s*([\d.]+)%,\s*([\d.]+)%(?:,\s*([\d.]+))?\)$/);
  if (hslaMatch) {
    const h = Math.round(parseFloat(hslaMatch[1]));
    const s = Math.round(parseFloat(hslaMatch[2]));
    const l = Math.round(parseFloat(hslaMatch[3]));
    const a = hslaMatch[4] !== undefined ? parseFloat(hslaMatch[4]) : 1;
    const [r, g, b] = hslToRgb(h, s, l);
    return { r, g, b, h, s, l, a, format: 'hsl' };
  }

  return { r: 0, g: 0, b: 0, h: 0, s: 0, l: 0, a: 1, format: 'hex' };
}

// --- Component ---

const model = defineModel<string>({ required: true });
const uid = useId();

const {
  r: pr,
  g: pg,
  b: pb,
  h: ph,
  s: ps,
  l: pl,
  a: pa,
  format: pf,
} = parseColorValue(model.value);

const format = ref<ColorFormat>(pf);
const r = ref(pr);
const g = ref(pg);
const b = ref(pb);
const h = ref(ph);
const s = ref(ps);
const l = ref(pl);
const a = ref(pa);

const hexValue = computed(() => rgbToHex(r.value, g.value, b.value));

const hexText = ref(hexValue.value);
let isEditingHexText = false;

watch(hexValue, (newHex) => {
  if (!isEditingHexText) {
    hexText.value = newHex;
  }
});

function buildColorString(): string {
  const alpha = parseFloat(a.value.toFixed(2));
  if (format.value === 'hsl') {
    return alpha < 1
      ? `hsla(${h.value}, ${s.value}%, ${l.value}%, ${alpha})`
      : `hsl(${h.value}, ${s.value}%, ${l.value}%)`;
  }
  if (format.value === 'rgb') {
    return alpha < 1
      ? `rgba(${r.value}, ${g.value}, ${b.value}, ${alpha})`
      : `rgb(${r.value}, ${g.value}, ${b.value})`;
  }
  // hex
  return alpha < 1
    ? `rgba(${r.value}, ${g.value}, ${b.value}, ${alpha})`
    : hexValue.value;
}

function emit() {
  model.value = buildColorString();
}

function onHexPickerChange(event: Event) {
  const hex = (event.target as HTMLInputElement).value;
  const [nr, ng, nb] = hexToRgb(hex);
  r.value = nr;
  g.value = ng;
  b.value = nb;
  const [nh, ns, nl] = rgbToHsl(nr, ng, nb);
  h.value = nh;
  s.value = ns;
  l.value = nl;
  emit();
}

function onHexTextInput(event: Event) {
  isEditingHexText = true;
  let val = (event.target as HTMLInputElement).value.trim();
  hexText.value = val;
  if (!val.startsWith('#')) val = '#' + val;
  if (/^#[\da-f]{3}$/i.test(val)) {
    val = '#' + val[1].repeat(2) + val[2].repeat(2) + val[3].repeat(2);
  }
  if (/^#[\da-f]{6}$/i.test(val)) {
    const [nr, ng, nb] = hexToRgb(val);
    r.value = nr;
    g.value = ng;
    b.value = nb;
    const [nh, ns, nl] = rgbToHsl(nr, ng, nb);
    h.value = nh;
    s.value = ns;
    l.value = nl;
    emit();
  }
}

function onHexTextBlur() {
  isEditingHexText = false;
  hexText.value = hexValue.value;
}

function onRgbChange() {
  const [nh, ns, nl] = rgbToHsl(r.value, g.value, b.value);
  h.value = nh;
  s.value = ns;
  l.value = nl;
  emit();
}

function onHslChange() {
  const [nr, ng, nb] = hslToRgb(h.value, s.value, l.value);
  r.value = nr;
  g.value = ng;
  b.value = nb;
  emit();
}

function setFormat(newFormat: ColorFormat) {
  format.value = newFormat;
  emit();
}

// Re-sync state when parent changes the value externally
watch(model, (newVal) => {
  if (newVal === buildColorString()) return;
  const p = parseColorValue(newVal);
  r.value = p.r;
  g.value = p.g;
  b.value = p.b;
  h.value = p.h;
  s.value = p.s;
  l.value = p.l;
  a.value = p.a;
  format.value = p.format;
});
</script>

<template>
  <div
    class="color-input"
    dir="ltr"
  >
    <HtFormControlGroup class="color-input-format">
      <HtFormControlSettings>
        <HtFormRadio
          :id="`${uid}-hex`"
          :name="`${uid}-format`"
          label="Hex"
          value="hex"
          :checked="format === 'hex'"
          checkboxes
          @change="setFormat('hex')"
        />
        <HtFormRadio
          :id="`${uid}-rgb`"
          :name="`${uid}-format`"
          label="RGB"
          value="rgb"
          :checked="format === 'rgb'"
          checkboxes
          @change="setFormat('rgb')"
        />
        <HtFormRadio
          :id="`${uid}-hsl`"
          :name="`${uid}-format`"
          label="HSL"
          value="hsl"
          :checked="format === 'hsl'"
          checkboxes
          @change="setFormat('hsl')"
        />
      </HtFormControlSettings>
    </HtFormControlGroup>
    <HtFormInputGroup class="color-input-fields">
      <HtFormControlSettings>
        <input
          class="input-field"
          type="color"
          :value="hexValue"
          @input="onHexPickerChange"
        >
        <input
          v-if="format === 'hex'"
          class="input-field"
          type="text"
          :value="hexText"
          placeholder="#000000"
          @input="onHexTextInput"
          @blur="onHexTextBlur"
        >
        <template v-if="format === 'rgb'">
          <HtInputGropupText>R</HtInputGropupText>
          <HtInput
            v-model="r"
            type="number"
            min="0"
            max="255"
            step="1"
            @input="onRgbChange"
          />
          <HtInputGropupText>G</HtInputGropupText>
          <HtInput
            v-model="g"
            type="number"
            min="0"
            max="255"
            step="1"
            @input="onRgbChange"
          />
          <HtInputGropupText>B</HtInputGropupText>
          <HtInput
            v-model="b"
            type="number"
            min="0"
            max="255"
            step="1"
            @input="onRgbChange"
          />
        </template>
        <template v-else-if="format === 'hsl'">
          <HtInputGropupText>H</HtInputGropupText>
          <HtInput
            v-model="h"
            type="number"
            min="0"
            max="360"
            step="1"
            @input="onHslChange"
          />
          <HtInputGropupText>S</HtInputGropupText>
          <HtInput
            v-model="s"
            type="number"
            min="0"
            max="100"
            step="1"
            @input="onHslChange"
          />
          <HtInputGropupText>L</HtInputGropupText>
          <HtInput
            v-model="l"
            type="number"
            min="0"
            max="100"
            step="1"
            @input="onHslChange"
          />
        </template>
        <HtInputGropupText align="right">
          &alpha;
        </HtInputGropupText>
        <HtInput
          v-model="a"
          type="number"
          min="0"
          max="1"
          step="0.01"
          @input="emit"
        />
      </HtFormControlSettings>
    </HtFormInputGroup>
  </div>
</template>
