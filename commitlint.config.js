export default {
  extends: ['@commitlint/config-conventional'],
  rules: {
    // Dependabot commit bodies routinely include long markdown links
    // (release notes / compare URLs) that exceed the default 100 char limit.
    'body-max-line-length': [0, 'always'],
  },
};
