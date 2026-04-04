export type ButtonColors = 'primary' | 'success' | 'danger' | 'warning' | 'light' | 'dark';

export interface GetButtonClassesOptions {
  'class'?: string | Record<string, boolean> | Array<string | undefined | Record<string, boolean>>,
  color?: ButtonColors,
  fullWidth?: boolean;
  pressed?: boolean;
  loading?: boolean;
  iconOnly?: boolean;
  justifyCenter?: boolean;
}

export const getButtonClasses = (props: GetButtonClassesOptions) => {
  const propsClass = Array.isArray(props.class) ? props.class : [props.class];
  return ['button', ...propsClass, {
    [`button-${props.color}`]: props.color,
    'full-width': props.fullWidth,
    pressed: props.pressed,
    loading: props.loading,
    'icon-only': props.iconOnly,
    'justify-center': props.justifyCenter,
  }];
};
