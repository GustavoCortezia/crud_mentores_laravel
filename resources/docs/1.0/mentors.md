
<a name="mentors"></a>

## Listagem de carros

<a name="request-mentors-all"></a>

### Endpoint (Visualizar todos)

Obtém uma lista contendo todos os mentores.
>

| Method |        URI         | Headers |
| :----: | :----------------: | :-----: |
|  GET   | `/mentors` |  Auth   |


#### Body rules

```json
{}
```

### Responses

> {success.fa-check-circle-o} Sucesso

Código `200`


```json
{
    
"mentores": [
        {
            "id": "number",
            "name": "string",
            "email": "string",
            "cpf": "string",
            "created_at": "date",
            "updated_at": "date"
        },
]
    
}
```

> {danger.fa-times-circle-o} Erro ao encontrar mentores

Código `500`

```json
{
        {
            "message": "string"
        }    
}
```


<a name="mentor"></a>

## Listagem de um mentor

### Endpoint (Visualizar um mentor)

Obtém o resumo de um mentor por id.

| Method |          URI          | Headers |
| :----: | :-------------------: | :-----: |
|  GET   | `/mentors/{id}` |  Auth   |


#### Body rules

```json
{}
```

### Responses

> {success.fa-check-circle-o} Sucesso

Código `200`

```json
{
    "success": "boolean",
    "msg": "string",
    "data": {
        "id": "number",
        "name": "string",
        "email": "string",
        "cpf": "string",
        "created_at": "date",
        "updated_at": "date"
    }
}
```


> {danger.fa-times-circle-o} Erro ao encontrar mentores

Código `404`

```json
{
    "success": "boolean",
    "message": "string"
}
```

---


<a name="mentor-register></a>

## Cadastro
### Endpoint (cadastrar um mentor)

Cadastra um mentor no sistema.



| Method | URI | Headers |
|:--------:|:--------:|:---------:|
| POST | `/mentors` | auth|


#### Body rules

```json
{
    "name" => "required|string",
    "email" => "required|email",
    "cpf" => "required|string"
}
```


### Responses

> {success.fa-check-circle-o} Sucesso: mentor cadastrado

Código `201`

```json
{
    "success": "boolean",
    "msg": "string",
    "data": {
        "id": "number",
        "name": "string",
        "email": "string",
        "cpf": "string",
        "created_at": "date",
        "updated_at": "date"
    }
}
```

> {danger.fa-times-circle-o} Erro ao cadastrar um mentor

Código `400`

```json
{
    "success": "boolean",
    "message": "string"
}
```

<a name="mentor-update"></a>

## Edição de um mentor

### Endpoint (Editar um mentor)

Permite editar as informações de um mentor existente.

| Method |  URI           | Headers |
| :----: | :------------: | :-----: |
|  PUT   | `/mentors/{id}` |  Auth   |

#### Body rules

```json
{
    "name" => "required|string",
    "email" => "required|email",
    "cpf" => "required|string"
}
```


### Responses

> {success.fa-check-circle-o} Sucesso: Mentor editado

Código `201`

```json
{
    "success": "boolean",
    "msg": "boolean",
    "data": {
        "id": "number",
        "name": "string",
        "email": "string",
        "cpf": "string",
        "created_at": "date",
        "updated_at": "date"
    }
}
```

> {danger.fa-times-circle-o} Erro ao editar mentor

Código `400`

```json
{
    "success": "boolean",
    "message": "string"
}
```

<a name="mentor-delete"></a>

## Exclusão de um mentor

### Endpoint (Excluir um mentor)

Permite excluir um mentor existente.

| Method |      URI       | Headers |
| :----: | :------------: | :-----: |
| DELETE | `/mentors/{id}` |  Auth   |

#### Body rules

```json
{}
```


### Responses

> {success.fa-check-circle-o} mentor excluido 

Código `201`

```json
{
    "success" : "boolean",
    "msg" : "string"
   
}
```

> {danger.fa-times-circle-o} Erro ao excluir mentor

Código `400`

```json
{
    "success" : "boolean",
    "msg" : "string"
}
```


