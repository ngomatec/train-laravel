# Plano de Desenvolvimento de Requisitos (PDR)

## Projeto: Blog MTec (Focado em Tecnologia da Informação)

### 1. Objetivo do Projeto

Desenvolver um blog dinâmico e responsivo voltado para o público de Tecnologia da Informação (TI). O sistema deve permitir a gestão de conteúdo (posts, categorias, autores) através de um painel administrativo com níveis hierárquicos de acesso, oferecendo uma experiência de leitura fluida no front-end e ferramentas robustas de gerenciamento no back-end.

### 2. Tecnologias Utilizadas

- **Back-end:** PHP (Laravel 10.x ou superior)
- **Front-end (Público):** HTML5, CSS3 (Puro), JavaScript (Puro/Vanilla)
- **Front-end (Painel):** Bootstrap 5
- **Banco de Dados:** MySQL
- **Dependências Principais:** Laravel Breeze/Sanctum (Autenticação), Intervention Image (Upload de Imagens), Laravel Scout (Busca - Opcional).

---

### 3. Estrutura de Acesso e Níveis de Utilizador

O sistema contará com três níveis de permissões:

| Nível | Acesso ao Painel | Permissões |
| :--- | :--- | :--- |
| **Admin** | Sim (Total) | CRUD completo de **Posts**, **Categorias**, **Autores** (gerenciamento de usuários). Configurações do blog. Visualização de todos os dados. |
| **Autor** | Sim (Restrito) | CRUD apenas de seus próprios **Posts**. Não pode gerenciar outros usuários ou categorias (apenas selecionar existentes). |
| **Visitante** | Não | Acesso apenas às páginas públicas (Home, Posts, Sobre). Pode utilizar o sistema de busca. |

---

### 4. Requisitos Funcionais (Features)

#### 4.1. Front-end (Páginas Públicas)

*As páginas devem ser construídas com HTML, CSS Puro e JS Puro.*

| Página | Descrição |
| :--- | :--- |
| **Home** | Listagem dos últimos posts (resumo, título, imagem destacada, nome do autor, data). Deve conter link para a página completa do post. |
| **Posts** | Listagem de todos os posts com **paginação** (ex: 10 posts por página). Filtros por categoria. |
| **Categorias** | Listagem de todas as categorias disponíveis. Ao clicar, redireciona para a página "Posts" filtrada pela categoria selecionada. |
| **Autores** | Listagem dos autores cadastrados. Exibir foto do perfil (avatar), nome, biografia resumida e link para ver todos os posts daquele autor. |
| **Sobre** | Página estática contendo a descrição do blog MTec, sua missão e informações de contato. |
| **Post Único** | Página de detalhe do artigo. Exibe título, conteúdo completo, imagem destacada, data, autor, categoria e sistema de comentários simples (opcional). |

#### 4.2. Painel de Administração

*Todo o painel deve utilizar Bootstrap 5 para responsividade e componentes prontos.*

| Módulo | Funcionalidades |
| :--- | :--- |
| **Dashboard** | Visão geral: quantidade de posts, usuários ativos, últimos posts publicados. |
| **Gerenciar Posts** | Listagem com busca e paginação. Botões: Criar, Editar, Excluir. **Upload de imagens** (destaque). |
| **Gerenciar Categorias** | Listagem, criação, edição e exclusão de categorias. |
| **Gerenciar Autores (Usuários)** | Listagem de usuários. Permissão para Admin criar novos usuários, definir se é "Admin" ou "Autor". |
| **Perfil** | Edição de dados pessoais e troca de senha. **Upload de imagem** de avatar. |

#### 4.3. Funcionalidades Transversais

| Feature | Descrição |
| :--- | :--- |
| **Sistema de Busca** | Campo de busca disponível no header das páginas públicas e no painel. Deve buscar por título e conteúdo do post. Deve ter paginação nos resultados. |
| **Paginação** | Implementada em todas as listagens (públicas e administrativas) para melhor performance. |
| **Login** | Sistema de autenticação. Visitantes que fazem login (e são Admin/Autor) são redirecionados para o Painel. Visitantes sem login veem apenas o front-end. |
| **Upload de Imagens** | Deve permitir upload de imagens para: Post (capa), Avatar do Autor. O sistema deve otimizar e armazenar os arquivos na pasta `storage/app/public`. |

---

### 5. Banco de Dados (Estrutura Sugerida)

#### Tabela: `users`

| Campo | Tipo | Descrição |
| :--- | :--- | :--- |
| id | Bigint | PK |
| name | String | Nome do Autor |
| email | String | Email (único) |
| password | String | Hash |
| avatar | String | Caminho da foto de perfil |
| role | Enum ('admin', 'author') | Controle de nível |
| bio | Text | Biografia do autor |

#### Tabela: `categories`

| Campo | Tipo | Descrição |
| :--- | :--- | :--- |
| id | Bigint | PK |
| name | String | Nome da Categoria (ex: PHP, Redes) |
| slug | String | Identificador amigável para URL |
| description | Text | Pequena descrição |

#### Tabela: `posts`

| Campo | Tipo | Descrição |
| :--- | :--- | :--- |
| id | Bigint | PK |
| title | String | Título do post |
| slug | String | Identificador amigável para URL |
| excerpt | Text | Resumo (pequeno trecho) |
| content | LongText | Conteúdo completo do artigo |
| image | String | Caminho da imagem de capa |
| published_at | Datetime | Data de publicação |
| user_id | Foreign Key | Relacionamento com `users` (autor) |
| category_id | Foreign Key | Relacionamento com `categories` |

---

### 6. Estrutura de Rotas (Sugestão Laravel)

**Grupo de Rotas Públicas (Visitante)**

- `GET /` -> HomeController@index
- `GET /posts` -> PostController@index
- `GET /posts/{slug}` -> PostController@show
- `GET /categorias` -> CategoryController@index
- `GET /categorias/{slug}` -> PostController@byCategory
- `GET /autores` -> AuthorController@index
- `GET /autores/{id}` -> PostController@byAuthor
- `GET /sobre` -> PageController@about
- `POST /buscar` -> SearchController@search

**Grupo de Rotas Privadas (Painel - Middleware Auth)**

- Prefixo: `/admin`
- `GET /dashboard` -> DashboardController@index
- `GET /posts/create` -> PostController@create (Autor/Admin)
- `POST /posts` -> PostController@store (Autor/Admin)
- `GET /posts/{id}/edit` -> PostController@edit (Autor/Admin - valida permissão)
- `PUT /posts/{id}` -> PostController@update
- `DELETE /posts/{id}` -> PostController@destroy
- `GET /categorias` -> CategoryController@index (Admin)
- `GET /categorias/create` -> CategoryController@create (Admin)
- `POST /categorias` -> CategoryController@store (Admin)
- `GET /users` -> UserController@index (Admin)
- `GET /users/create` -> UserController@create (Admin)
- `POST /users` -> UserController@store (Admin)
- `PUT /users/{id}` -> UserController@update (Admin/Próprio usuário)
- `DELETE /users/{id}` -> UserController@destroy (Admin)

---

### 7. Regras de Negócio

1. **Exclusão de Categoria:** Um Admin não pode excluir uma categoria que possua posts vinculados, a menos que os posts sejam reatribuídos para outra categoria primeiro.
2. **Visibilidade de Posts:** Posts só devem aparecer no front-end se tiverem uma data `published_at` menor ou igual à data/hora atual (publicação agendada).
3. **Permissão de Autor:** Um Autor só pode editar/excluir posts onde o campo `user_id` corresponda ao seu ID.
4. **Imagens:** Ao fazer upload, o sistema deve gerar um nome único para o arquivo para evitar conflitos de cache. Tamanho máximo recomendado: 2MB.

---

### 8. Cronograma Estimado (Sugestão)

| Fase | Atividades | Duração |
| :--- | :--- | :--- |
| **1. Configuração** | Instalação Laravel, configuração DB, autenticação (Breeze). | 1 dia |
| **2. Back-end (Models/Migrations)** | Criação das Models, Migrations, Seeders (roles, categorias). | 1 dia |
| **3. Painel (CRUD)** | Desenvolvimento do CRUD de Categorias, Usuários e Posts com Upload de imagem. | 3 dias |
| **4. Front-end (Público)** | Criação das views em HTML/CSS/JS puro para Home, Posts, Autores, Sobre, integração com dados do banco. | 3 dias |
| **5. Features** | Implementação da Busca e Paginação em todas as listagens. | 1 dia |
| **6. Segurança** | Implementação das Policies (Admin vs Autor) e validações de formulário. | 1 dia |
| **7. Testes e Ajustes** | Testes de responsividade, permissões e correção de bugs. | 1 dia |

### 9. Considerações Finais

- **CSS Puro:** O front-end público deve ter um visual moderno (foco em TI, tons escuros ou claros com detalhes em azul/verde), sem dependência de frameworks CSS como Bootstrap.
- **JS Puro:** Funcionalidades interativas no front-end (como menu mobile, confirmação de exclusão, etc.) devem ser implementadas em JavaScript Vanilla.
- **Segurança:** Todas as rotas de painel devem estar protegidas pelo middleware `auth` e políticas de acesso (Gates/Policies) para garantir que Autores não acessem dados de Admin.

---
**Responsável:** Ngoma Fortna
**Data:** 26/03/2026
