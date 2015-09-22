# Code Login for OctoberCMS

Front-end users login form - only by code/password.

## Dependencies

RainLab.User plugin.

## Installation

On frontend we need to inject {% framework extras %} to layout and be sure to have jQuery included:

```
<script src="{{ 'assets/javascript/site.vendor.js' | theme }}"></script>
<script src="{{ 'assets/javascript/site.js' | theme }}"></script>
{% scripts %}
{% framework extras %}
```

If form doesn't work, try to insert component to page, not to partial.
