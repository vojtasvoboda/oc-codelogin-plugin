# Code Login for OctoberCMS

Login only by code or password. Create secret page or protect whole site just in minute.

## Dependencies

RainLab.User plugin for users management.

## How to create secret page

0) Install [VojtaSvoboda.CodeLogin](http://octobercms.com/plugin/vojtasvoboda-codelogin) plugin.

1) Insert RainLab.User Session component to layout which you want to protect by code.

<p>
    <img src="assets/images/1-place-session-component.png" alt="Screenshot of Session component placed at layout">
</p>

Set Allow property only for Users (means logged users) and then set your login page. All guests will be redirect to login page.

Be sure you injected JavaScript code and jQuery to your layout:

```
<script src="{{ 'assets/javascript/site.vendor.js' | theme }}"></script>
<script src="{{ 'assets/javascript/site.js' | theme }}"></script>
{% scripts %}
{% framework extras %}
```

2) Create login page and insert RainLab.User Session component and Code login form. In my example Login page uses Login layout. Session component set to allow all users (login allowed for everyone).

<p>
    <img src="assets/images/2-create-login-page.png" alt="Screenshot of Login page with Session and Code login form">
</p>

Set redirect parameter to your secret page and then set if you want to use input type text or input type password (code will not be visible).

<p>
    <img src="assets/images/3-password-visible-or-not.png" alt="Screenshot of Login form with visible password">
</p>

3) Use default HTML or create own design by extending component template:

- create file `/partials/codeLogin/default.htm`
- copy content from original component template `/components/codelogin/default.htm`
- add classes or HTML you needed

<p>
    <img src="assets/images/4-create-your-own-design.png" alt="Screenshot of custom designs">
</p>

4) At RainLab.User plugin create as many users as you want. It's recommanded to use unique password for each user, because first user with matched password will be log!

## Events

List of events provided by plugin:

- _vojtasvoboda.codelogin.afterlogin_ - event fired after successfull login. `$user` parameter is injected and contain instance of successfully logged user.

## Troubleshooting

### Login button doesn't works.

Be sure you have included jQuery and `{% framework extras %}` code to your layout.

### AJAX handler 'codeLogin::onCodesignin' was not found.

If form doesn't work, try to insert Code login component to page, not to partial. Login component should be placed beside to Session component.

## License

Access log plugin is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT) same as OctoberCMS platform.

## Contributing

**Feel free to send pullrequest!**

Please send Pull Request to master branch.