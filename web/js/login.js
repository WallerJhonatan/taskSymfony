function authenticaUsuario() {
    $.ajax({
        cache: false,
        type: 'post',
        dataType: 'json',
        url: '/login_check',
        data: { _username: 'admin',
                _password: 'admin3'},
        success: function(data) {
            alert('ok'); return false;
            window.localStorage.setItem('token', data.token);
        },
        error: function (jqXHR, exception) {
            localStorage.token = undefined;
            alert(jqXHR.status); return false;
        }
    });
}