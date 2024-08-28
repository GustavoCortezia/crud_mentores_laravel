# Usuários

- [**Cadastro**](#sign-up)
- [Criar conta `Request`](#request-register)
- [**Autenticação**](#auth)
- [Login `Request`](#request-login)



<a name="sign-up"></a>

## Cadastro de novos usuários

O cadastro de usuários é feito de forma independente em um serviço de autenticação. Após o cadastro criado neste serviço, um registro será criado na tabela `users`. Este registro, será utilizado como usuário nas áreas autenticadas.

<a name="request-register"></a>


### Endpoint (Criar conta)

Para criar um novo usuário, enviar request conforme dados exemplificados abaixo. 

| Method | URI | Headers |
|:--------:|:--------:|:---------:|
| POST | `/register` | - |


#### Body rules

```json
{
    "name" => "required|string",
    "email" => "required|email|unique:users,email",
    "password" => "required|string"
}
```

### Responses

> {success.fa-check-circle-o} Usuário cadastrado

Código `201`

```json
{
    "success": "boolean",
    "msg": "string", 
    "user": {
        "name": "string",
        "email": "string",
        "role": "string",
        "updated_at": "date",
        "created_at": "date",
        "id": "number"
    }
}
```

> {danger.fa-times-circle-o} E-mail em uso por outro usuário

Código `409`

```json
{
    "success": "boolean",
    "message": "string"
}
```

<a name="auth"></a>

## Autenticação

A autenticação é realizada via tokens. Para todas as rotas protegidas devem ser enviadas em seus cabeçalhos o parâmetro:

```json
{
    "Authorization": "Bearer {...token}"
}
```


<a name="request-login"></a>

### Endpoint (Login)

o processo de login  ocorre consultando o serviço de autenticação, caso os dados existam e sejam válidos,  é aplicado as facades de autenticação.

| Method | URI | Headers 
|:--------:|:--------:
| POST | `/login` | 


#### Body rules

```json
{
    "email": "required|email",
    "password": "required"
}
```

### Responses

> {success.fa-check-circle-o} Login bem-sucedido

Código `200`

```json
{
    "success": "boolean",
    "msg": "string",
    "data": {
        "id": "number",
        "name": "string",
        "email": "string",
        "email_verified_at": null,
        "role": "string",
        "created_at": "date",
        "updated_at": "date"
    },
    "token": "string|token"
}
```

> {danger.fa-times-circle-o} E-mail ou senha invalido!

Código `401`

```json
{
    "success": "boolean",
    "message": "string"
}
```



