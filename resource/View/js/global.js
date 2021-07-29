const SOURCE = 'http://localhost/project/crud-jquery-php';

// Logar no sistema
$(document).on('submit', '[data-login]', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    if (!formData) {
        throw new Error('Formulario não encontrado!');
    }

    $.ajax({
        url: SOURCE + '/ajax/App/Controller/Validate/UserLogin',
        data: formData,
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status === 'sucesso') {
                $('[data-button-login]').text(data.response);

                setTimeout(function() {
                    window.location.href = SOURCE + '/listagem';
                }, 3000);
            }else{
                alert(data.response);
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
});


// Cadastro de usuarios
$(document).on('submit', '[data-form-register]', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    if (!formData) {
        throw new Error('Formulario não encontrado!');
    }

    $.ajax({
        url: SOURCE + '/ajax/App/Controller/Action/RegisterUser',
        data: formData,
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status === 'sucesso') {
                alert(data.response)
                window.location.href = SOURCE + '/listagem';
            }else{
                alert(data.response);
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
});


// Edição de usuarios
$(document).on('submit', '[data-form-update]', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    if (!formData) {
        throw new Error('Formulario não encontrado!');
    }

    $.ajax({
        url: SOURCE + '/ajax/App/Controller/Action/UpdateUser',
        data: formData,
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status === 'sucesso') {
                alert(data.response)
                window.location.href = SOURCE + '/listagem';
            } else {
                alert(data.response);
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
});



// Excluir usuario
$(document).on('click', '[data-delete-user]', function (event) {
    event.preventDefault();

    const id = $(this).attr('data-id');

    console.log(id);

    if (!id) {
        alert('Identificador não encontrado!');
        return;
    }

    if (confirm('Tem certeza que deseja excluir esse usuario?')) {
        $.ajax({
            url: SOURCE + '/ajax/App/Controller/Action/DeleteUser',
            data: {
                id: id
            },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.status === 'sucesso') {
                    alert(data.response);
                    window.location.reload();
                } else {
                    alert(data.response);
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
});

// LogOut
$(document).on('click', '[data-deslogar]', function(event) {
    event.preventDefault();

    $.ajax({
        data: {},
        url: SOURCE + '/ajax/App/Controller/Action/SessionDestroy',
        type: 'POST',
        dataType: 'json',
        success: function(data){
            if (data.status === 'sucesso') {
                window.location.href = SOURCE;
            }else {
                alert('Erro ao deslogar');
            }
        },
        error: function(data) {
            console.log(data)
        }
    })

});