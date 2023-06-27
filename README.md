## Programming Challenge SaperX

---
### Installation Tutorial
----

1. Clone this project to your computer.
2. Open project folder
3. Type composer install on terminal
4. Type npm install on terminal
5. After this, type php artisan serve and npm run dev on terminal

---

### Run Tests:

1. Type ./vendor/bin/phpunit on terminal
2. Await results :D

---
## phoneBook API

Prefix: `/api`

| Method | Route                | Description              |
| ------ | -------------------  | ------------------------ |
| GET    | `/`                  | Obter lista telefônica   |
| POST   | `/store`             | Adicionar contato        |
| PUT    | `/update/{id}`       | Atualizar contato        |
| DELETE | `/delete/{id}`       | Excluir contato          |

#### Validation for Create and Update:

| Name  | Rules                           |
| ------| ------------------------------  |
| DDD   | required, numeric, 2 digits     |
| name  | required, text, max 255 digits  |
| city  | required, text, max 255 digits  |
###

---

## Contact API

Prefix: `/agenda/{idPhoneBook}`


| Método | Rota                      | Descrição                |
| ------ | ------------------------- | ------------------------ |
| GET    | `/listar-contatos`        | Obter lista de contatos  |
| POST   | `/store`                  | Adicionar contato        |
| PUT    | `/update/{contact}`       | Atualizar contato        |
| DELETE | `/delete/{contact}`       | Excluir contato          |

### Validation to Create and Update

| Name       | Rules                                                     |
| ---------- | --------------------------------------------------------- |
| birthday   | required, date                                            |
| email      | required, e-mail, max 255 digits                          |
| phone      | required, text, 11 digits                                 |
| name       | required, text, max 255 digits                            |
| cpf        | required, text, 11 digits                                 |

---

### Payloads examples for PhoneBook API

#### GET - Index Method

##### Endpoint: /api/lista-telefonica/

1. Response:

- Nenhum item cadastrado:

```json
[
    "data": []
]
```
- Item cadastrado:
```json
{
    "data": [
        {
            "identify": 2,
            "name": "Agenda 1",
            "city": "São Sebastião",
            "DDD": "12"
        },
        {
            "identify": 3,
            "name": "Agenda 2",
            "city": "São Paulo",
            "DDD": "11"
        }
    ]
}
```
#### POST - Create Method

##### Endpoint: /api/lista-telefonica/store

1. Body:
```json
{
    "name": "Agenda 3",
    "city": "Caraguatatuba",
    "DDD": "12"
}
```
2. Response:

```json
{
    "data": {
        "identify": 4,
        "name": "Agenda 3",
        "city": "Caraguatatuba",
        "DDD": "12"
    }
}
```

#### PUT - Update Method

##### Endpoint: /api/lista-telefonica/update/{id}

1. Body:
```json
{
    "name": "Agenda 3",
    "city": "Ubatuba",
    "DDD": "12"
}
```
2. Response:

```json
{
    "data": {
        "identify": 4,
        "name": "Agenda 3",
        "city": "Ubatuba",
        "DDD": "12"
    }
}
```

#### DELETE - Destroy Method

##### Endpoint: /api/lista-telefonica/delete/{id}

1. Response:
```json
Success: 204, no content.
Error: 404, not found
```

#### Invalid data - Default responses:

1. Body:

```json
{
    "name": "000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000",
    "city": ""
}
```
2. Response:
```json
{
    "success": false,
    "message": "Erro de validação",
    "data": {
        "DDD": [
            "O campo DDD é obrigatório."
        ],
        "name": [
            "O campo nome não pode ser superior a 255 caracteres."
        ],
        "city": [
            "O campo cidade é obrigatório."
        ]
    }
}
```
---
### Payloads examples for Contact API

#### GET - Index Method

##### Endpoint: /api/agenda/{idPhoneBook}/listar-contatos

1. Response:

- Nenhum item cadastrado

```json
{
    "data": []
}
```
- Item castrado:
```json
{
    "data": [
        {
            "phoneBook": {
                "identify": 7,
                "name": "Agenda 3",
                "city": "Caraguatatuba",
                "DDD": "12"
            },
            "identify": 1,
            "birthday": "2002-12-12",
            "phone": "12996351784",
            "email": "developer.caiowillwohl@gmail.com",
            "name": "Caio Ribeiro",
            "cpf": "66452290037"
        }
    ]
}
```

#### POST - Create Method

##### Endpoint: /api/agenda/{idPhoneBook}/store

1. Data:

```json
{
    "birthday": "2004-07-15",
    "email": "josef_garcia@gmail.com",
    "phone": "12965481131",
    "name": "Josef Garcia",
    "cpf": "97814403090"
}
```
2. Response:
```json
{
    "data": {
        "phoneBook": {
            "identify": 8,
            "name": "Agenda 3",
            "city": "Caraguatatuba",
            "DDD": "12"
        },
        "identify": 8,
        "birthday": "2004-07-15",
        "phone": "12965481131",
        "email": "josef_garcia@gmail.com",
        "name": "Josef Garcia",
        "cpf": "97814403090"
    }
}
```

#### PUT - Update Method

##### Endpoint: /api/agenda/{idPhoneBook}/update/{id}

1. Data:

```json
{
    "birthday": "2006-07-15",
    "phone": "12965481131",
    "email": "josef_garcia@outlook.com",
    "name": "Josef Leroy",
    "cpf": "97814403090"
}
```
2. Response:
```json
{
    "data": {
        "phoneBook": {
            "identify": 8,
            "name": "Agenda 3",
            "city": "Caraguatatuba",
            "DDD": "12"
        },
        "identify": 8,
        "birthday": "2006-07-15",
        "phone": "12965481131",
        "email": "josef_garcia@outlook.com",
        "name": "Josef Leroy",
        "cpf": "97814403090"
    }
}
```
#### DELETE - Destroy Method

##### Endpoint: /api/agenda/{idPhoneBook}/delete/{id}

1. Response:
```json
Success: 204, no content.
Error: 404, not found
```
#### Invalid data - Default responses:

1. Body:

```json
{
    "birthday": "invalid-data",
    "phone": "89779879879879879798798798",
    "email": ""
}
```
2. Response:

```json
{
    "success": false,
    "message": "Erro de validação",
    "data": {
        "birthday": [
            "O campo Data de nascimento não é uma data válida."
        ],
        "email": [
            "O campo E-mail é obrigatório."
        ],
        "phone": [
            "O campo Telefone não pode ser superior a 11 caracteres."
        ],
        "name": [
            "O campo Nome é obrigatório."
        ],
        "cpf": [
            "O campo CPF é obrigatório."
        ]
    }
}
```


