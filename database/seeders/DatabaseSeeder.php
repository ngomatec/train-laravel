<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuário Admin
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@mtec.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'bio' => 'Administrador do blog MTec, apaixonado por tecnologia e inovação.',
            'avatar' => null,
        ]);

        // Criar usuário Autor
        $author = User::create([
            'name' => 'João Silva',
            'email' => 'autor@mtec.com',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'bio' => 'Especialista em PHP e Laravel, desenvolvedor full-stack com mais de 8 anos de experiência.',
            'avatar' => null,
        ]);

        // Criar segundo autor
        $author2 = User::create([
            'name' => 'Maria Santos',
            'email' => 'maria@mtec.com',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'bio' => 'Engenheira de software especializada em JavaScript e React. Palestrante e comunidade open source.',
            'avatar' => null,
        ]);

        // Criar terceiro autor
        $author3 = User::create([
            'name' => 'Pedro Oliveira',
            'email' => 'pedro@mtec.com',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'bio' => 'Especialista em DevOps e Cloud Computing, com experiência em AWS e Kubernetes.',
            'avatar' => null,
        ]);

        // Criar categorias
        $categories = [
            ['name' => 'PHP', 'slug' => 'php', 'description' => 'Artigos sobre PHP e Laravel - Aprenda desde o básico até tópicos avançados'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'description' => 'JavaScript, Node.js e frameworks frontend - O ecossistema JavaScript completo'],
            ['name' => 'DevOps', 'slug' => 'devops', 'description' => 'Docker, Kubernetes e CI/CD - Práticas modernas de desenvolvimento e operações'],
            ['name' => 'Banco de Dados', 'slug' => 'banco-de-dados', 'description' => 'MySQL, PostgreSQL e NoSQL - Otimização e modelagem de dados'],
            ['name' => 'Segurança', 'slug' => 'seguranca', 'description' => 'Segurança da informação e boas práticas - Proteja suas aplicações'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Buscar categorias por ID
        $phpCategory = Category::where('slug', 'php')->first();
        $jsCategory = Category::where('slug', 'javascript')->first();
        $devopsCategory = Category::where('slug', 'devops')->first();
        $dbCategory = Category::where('slug', 'banco-de-dados')->first();
        $securityCategory = Category::where('slug', 'seguranca')->first();

        // ==================== POSTS PARA CATEGORIA PHP ====================
        $phpPosts = [
            [
                'title' => 'Introdução ao Laravel 11: Novidades e Primeiros Passos',
                'slug' => 'introducao-ao-laravel-11',
                'excerpt' => 'Conheça as principais novidades do Laravel 11 e aprenda como iniciar seus projetos com o framework mais popular do PHP.',
                'content' => '<h2>O que há de novo no Laravel 11?</h2>
                <p>O Laravel 11 foi lançado com diversas melhorias significativas que tornam o desenvolvimento ainda mais ágil e poderoso. Neste artigo, vamos explorar as principais novidades e mostrar como começar seus projetos com esta nova versão.</p>
                
                <h3>Principais Novidades</h3>
                <ul>
                    <li><strong>Estrutura de arquivos simplificada:</strong> Menos arquivos boilerplate, mais produtividade</li>
                    <li><strong>Novo método de definição de rotas:</strong> API mais intuitiva</li>
                    <li><strong>Melhorias no SQLite:</strong> Suporte a foreign key constraints por padrão</li>
                    <li><strong>Graceful Encryption:</strong> Criptografia mais elegante</li>
                </ul>
                
                <h3>Como começar</h3>
                <p>Para criar um novo projeto com Laravel 11, basta executar:</p>
                <pre><code>composer create-project laravel/laravel meu-projeto</code></pre>
                
                <p>O Laravel 11 representa um marco na evolução do framework, trazendo simplicidade sem sacrificar a potência que conhecemos.</p>',
                'user_id' => $author->id,
                'category_id' => $phpCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Design Patterns em PHP: Singleton, Factory e Strategy na Prática',
                'slug' => 'design-patterns-php-singleton-factory-strategy',
                'excerpt' => 'Aprenda a implementar os padrões de projeto mais utilizados em PHP com exemplos práticos e aplicações reais.',
                'content' => '<h2>Padrões de Projeto em PHP</h2>
                <p>Os padrões de projeto (Design Patterns) são soluções reutilizáveis para problemas comuns no desenvolvimento de software. Neste artigo, vamos explorar três dos padrões mais utilizados em PHP.</p>
                
                <h3>Singleton Pattern</h3>
                <p>O Singleton garante que uma classe tenha apenas uma instância e fornece um ponto global de acesso a ela.</p>
                <pre><code>class DatabaseConnection {
    private static $instance = null;
    
    private function __construct() {}
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}</code></pre>
                
                <h3>Factory Pattern</h3>
                <p>O Factory Method define uma interface para criar objetos, mas permite que as subclasses decidam qual classe instanciar.</p>
                
                <h3>Strategy Pattern</h3>
                <p>O Strategy permite definir uma família de algoritmos, encapsular cada um deles e torná-los intercambiáveis.</p>
                
                <p>Estes padrões são fundamentais para escrever código mais limpo, testável e de fácil manutenção.</p>',
                'user_id' => $author->id,
                'category_id' => $phpCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'PHP 8.4: Todas as Novidades e Melhorias',
                'slug' => 'php-8-4-novidades-melhorias',
                'excerpt' => 'Descubra tudo o que está chegando com o PHP 8.4, incluindo novas funcionalidades, melhorias de performance e recursos inovadores.',
                'content' => '<h2>PHP 8.4: O Futuro do PHP</h2>
                <p>O PHP 8.4 está chegando com diversas funcionalidades empolgantes que vão melhorar ainda mais a experiência de desenvolvimento. Vamos explorar as principais novidades.</p>
                
                <h3>Propriedades Assíncronas</h3>
                <p>Uma das grandes adições é o suporte a propriedades assíncronas, facilitando ainda mais o trabalho com operações não bloqueantes.</p>
                
                <h3>Novas Funções de Array</h3>
                <pre><code>array_find($array, fn($value) => $value > 10);
array_find_key($array, fn($value) => $value > 10);</code></pre>
                
                <h3>Melhorias na JIT (Just-In-Time Compilation)</h3>
                <p>A JIT foi significativamente melhorada, oferecendo ganhos de performance ainda maiores para aplicações que processam muitas operações matemáticas.</p>
                
                <p>Prepare-se para migrar seus projetos e aproveitar todas essas novidades!</p>',
                'user_id' => $author->id,
                'category_id' => $phpCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Testes Automatizados com PHPUnit: Do Zero ao Avançado',
                'slug' => 'testes-automatizados-phpunit',
                'excerpt' => 'Guia completo para implementar testes automatizados em PHP usando PHPUnit, desde os conceitos básicos até técnicas avançadas.',
                'content' => '<h2>Testes Automatizados com PHPUnit</h2>
                <p>Escrever testes automatizados é essencial para garantir a qualidade e estabilidade do seu código. Neste guia, vamos aprender tudo sobre PHPUnit, o framework de testes mais popular do PHP.</p>
                
                <h3>Configuração Inicial</h3>
                <pre><code>composer require --dev phpunit/phpunit</code></pre>
                
                <h3>Escrevendo seu Primeiro Teste</h3>
                <pre><code>use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase {
    public function testAdd() {
        $calc = new Calculator();
        $this->assertEquals(5, $calc->add(2, 3));
    }
}</code></pre>
                
                <h3>Tipos de Testes</h3>
                <ul>
                    <li><strong>Testes Unitários:</strong> Testam unidades isoladas de código</li>
                    <li><strong>Testes de Integração:</strong> Verificam a interação entre componentes</li>
                    <li><strong>Testes Funcionais:</strong> Testam funcionalidades completas</li>
                </ul>
                
                <p>Implementar testes desde o início do projeto economiza tempo e evita bugs em produção!</p>',
                'user_id' => $author2->id,
                'category_id' => $phpCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'APIs RESTful com Laravel: Guia Definitivo',
                'slug' => 'apis-restful-laravel-guia',
                'excerpt' => 'Aprenda a construir APIs RESTful robustas e escaláveis utilizando o Laravel, com autenticação, versionamento e boas práticas.',
                'content' => '<h2>Construindo APIs RESTful com Laravel</h2>
                <p>O Laravel oferece ferramentas poderosas para criar APIs RESTful de alta qualidade. Vamos explorar as melhores práticas e recursos disponíveis.</p>
                
                <h3>Estrutura de uma API RESTful</h3>
                <p>Uma API RESTful deve seguir os princípios REST, utilizando métodos HTTP corretamente:</p>
                <ul>
                    <li>GET /api/posts - Listar recursos</li>
                    <li>POST /api/posts - Criar recurso</li>
                    <li>PUT /api/posts/{id} - Atualizar recurso</li>
                    <li>DELETE /api/posts/{id} - Remover recurso</li>
                </ul>
                
                <h3>Autenticação com Laravel Sanctum</h3>
                <pre><code>composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"</code></pre>
                
                <h3>Versionamento de API</h3>
                <p>Utilize rotas prefixadas por versão para manter compatibilidade:</p>
                <pre><code>Route::prefix(\'v1\')->group(function () {
    Route::apiResource(\'posts\', PostController::class);
});</code></pre>
                
                <p>Com estas práticas, você construirá APIs profissionais e escaláveis!</p>',
                'user_id' => $author->id,
                'category_id' => $phpCategory->id,
                'published_at' => now(),
            ],
        ];

        // ==================== POSTS PARA CATEGORIA JAVASCRIPT ====================
        $jsPosts = [
            [
                'title' => 'JavaScript Assíncrono: Promises, Async/Await e Callbacks',
                'slug' => 'javascript-assincrono-promises-async-await',
                'excerpt' => 'Aprenda a lidar com operações assíncronas em JavaScript de forma elegante e eficiente.',
                'content' => '<h2>Programação Assíncrona em JavaScript</h2>
                <p>JavaScript é single-threaded, mas possui mecanismos poderosos para lidar com operações assíncronas. Vamos explorar as principais abordagens.</p>
                
                <h3>Callbacks: O Início de Tudo</h3>
                <pre><code>setTimeout(() => {
    console.log("Executado após 1 segundo");
}, 1000);</code></pre>
                
                <h3>Promises: Uma Evolução Necessária</h3>
                <pre><code>const promise = new Promise((resolve, reject) => {
    // Operação assíncrona
    resolve("Sucesso!");
});

promise.then(result => console.log(result));</code></pre>
                
                <h3>Async/Await: Sintaxe Moderna</h3>
                <pre><code>async function fetchData() {
    try {
        const response = await fetch("https://api.example.com/data");
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error(error);
    }
}</code></pre>
                
                <p>Dominar programação assíncrona é essencial para qualquer desenvolvedor JavaScript!</p>',
                'user_id' => $author2->id,
                'category_id' => $jsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'React 19: Novidades e Como Migrar',
                'slug' => 'react-19-novidades-migracao',
                'excerpt' => 'Tudo o que você precisa saber sobre o React 19, incluindo o novo compilador, Actions e melhorias de performance.',
                'content' => '<h2>React 19: A Próxima Evolução</h2>
                <p>O React 19 traz mudanças significativas que vão transformar a forma como desenvolvemos aplicações React. Vamos explorar as principais novidades.</p>
                
                <h3>React Compiler</h3>
                <p>O React agora inclui um compilador que otimiza automaticamente a renderização, eliminando a necessidade de hooks como useMemo e useCallback em muitos casos.</p>
                
                <h3>Actions</h3>
                <p>As Actions são uma nova forma de lidar com operações assíncronas de forma declarativa:</p>
                <pre><code>function Form() {
    const [isPending, startTransition] = useTransition();
    
    const handleSubmit = async (formData) => {
        await submitForm(formData);
    };
    
    return (
        <form action={handleSubmit}>
            {/* ... */}
        </form>
    );
}</code></pre>
                
                <h3>Melhorias no useFormStatus e useFormState</h3>
                <p>Novos hooks para gerenciamento de estado de formulários simplificam drasticamente o desenvolvimento.</p>
                
                <p>Prepare seus projetos para migrar e aproveitar todas essas novidades!</p>',
                'user_id' => $author2->id,
                'category_id' => $jsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Node.js: Criando APIs Escaláveis com Express.js',
                'slug' => 'nodejs-apis-escalaveis-express',
                'excerpt' => 'Aprenda a construir APIs robustas e escaláveis utilizando Node.js e Express.js com boas práticas de arquitetura.',
                'content' => '<h2>APIs com Node.js e Express</h2>
                <p>Node.js combinado com Express.js é uma das combinações mais poderosas para construir APIs backend. Vamos criar uma API completa do zero.</p>
                
                <h3>Configuração do Projeto</h3>
                <pre><code>npm init -y
npm install express mongoose dotenv
npm install --save-dev nodemon</code></pre>
                
                <h3>Estrutura de Pastas</h3>
                <pre><code>src/
├── controllers/
├── models/
├── routes/
├── middlewares/
├── config/
└── app.js</code></pre>
                
                <h3>Exemplo de Controller</h3>
                <pre><code>class UserController {
    async index(req, res) {
        const users = await User.find();
        res.json(users);
    }
    
    async store(req, res) {
        const user = await User.create(req.body);
        res.status(201).json(user);
    }
}</code></pre>
                
                <h3>Middlewares de Autenticação</h3>
                <p>Implemente middlewares para proteger suas rotas e validar tokens JWT.</p>
                
                <p>Com esta estrutura, você terá uma API profissional e de fácil manutenção!</p>',
                'user_id' => $author2->id,
                'category_id' => $jsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'TypeScript: Guia Completo para Iniciantes',
                'slug' => 'typescript-guia-completo-iniciantes',
                'excerpt' => 'Aprenda TypeScript do zero, entenda seus benefícios e como ele pode tornar seu código JavaScript mais seguro e escalável.',
                'content' => '<h2>TypeScript: JavaScript com Tipos</h2>
                <p>TypeScript é um superset do JavaScript que adiciona tipagem estática, tornando o desenvolvimento mais seguro e produtivo.</p>
                
                <h3>Por que usar TypeScript?</h3>
                <ul>
                    <li>Detecção de erros em tempo de compilação</li>
                    <li>Melhor autocompletar e documentação</li>
                    <li>Código mais legível e auto-documentado</li>
                    <li>Refatoração mais segura</li>
                </ul>
                
                <h3>Tipos Básicos</h3>
                <pre><code>let nome: string = "João";
let idade: number = 30;
let ativo: boolean = true;
let habilidades: string[] = ["JavaScript", "TypeScript"];</code></pre>
                
                <h3>Interfaces e Types</h3>
                <pre><code>interface Usuario {
    id: number;
    nome: string;
    email: string;
    idade?: number;
}

const usuario: Usuario = {
    id: 1,
    nome: "Maria",
    email: "maria@email.com"
};</code></pre>
                
                <h3>Generics</h3>
                <p>Generics permitem criar componentes reutilizáveis que trabalham com diferentes tipos.</p>
                <pre><code>function identity<T>(arg: T): T {
    return arg;
}</code></pre>
                
                <p>TypeScript é essencial para projetos JavaScript de médio e grande porte!</p>',
                'user_id' => $author2->id,
                'category_id' => $jsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Vue.js 3: Composition API vs Options API',
                'slug' => 'vuejs-3-composition-options-api',
                'excerpt' => 'Entenda as diferenças entre Composition API e Options API no Vue.js 3 e saiba qual usar em seus projetos.',
                'content' => '<h2>Vue.js 3: Evolução e Flexibilidade</h2>
                <p>O Vue.js 3 trouxe uma nova forma de organizar componentes com a Composition API, mas a Options API continua totalmente suportada. Vamos comparar ambas abordagens.</p>
                
                <h3>Options API (Tradicional)</h3>
                <pre><code>export default {
    data() {
        return {
            count: 0
        }
    },
    methods: {
        increment() {
            this.count++
        }
    }
}</code></pre>
                
                <h3>Composition API (Moderna)</h3>
                <pre><code>&lt;script setup&gt;
import { ref } from "vue"

const count = ref(0)
const increment = () => count.value++
&lt;/script&gt;</code></pre>
                
                <h3>Quando usar cada uma?</h3>
                <ul>
                    <li><strong>Options API:</strong> Ideal para componentes simples e para quem está começando</li>
                    <li><strong>Composition API:</strong> Melhor para componentes complexos, reutilização de lógica e grandes projetos</li>
                </ul>
                
                <p>A escolha entre as APIs depende do seu contexto e preferência pessoal!</p>',
                'user_id' => $author2->id,
                'category_id' => $jsCategory->id,
                'published_at' => now(),
            ],
        ];

        // ==================== POSTS PARA CATEGORIA DEVOPS ====================
        $devopsPosts = [
            [
                'title' => 'Docker para Desenvolvedores: Do Zero ao Docker Compose',
                'slug' => 'docker-para-desenvolvedores',
                'excerpt' => 'Guia prático para containerizar suas aplicações com Docker, desde os conceitos básicos até o Docker Compose.',
                'content' => '<h2>Docker: Revolucionando o Desenvolvimento</h2>
                <p>Docker transformou a forma como desenvolvemos, testamos e deployamos aplicações. Vamos aprender os fundamentos e como aplicar no dia a dia.</p>
                
                <h3>O que é Docker?</h3>
                <p>Docker é uma plataforma de containerização que permite empacotar aplicações e suas dependências em containers isolados.</p>
                
                <h3>Comandos Essenciais</h3>
                <pre><code># Baixar uma imagem
docker pull nginx

# Executar um container
docker run -d -p 8080:80 --name meu-nginx nginx

# Listar containers
docker ps

# Parar um container
docker stop meu-nginx</code></pre>
                
                <h3>Dockerfile: Criando Imagens Personalizadas</h3>
                <pre><code>FROM php:8.2-apache
COPY . /var/www/html/
RUN docker-php-ext-install pdo_mysql</code></pre>
                
                <h3>Docker Compose: Multi-containers</h3>
                <pre><code>version: "3.8"
services:
  app:
    build: .
    ports:
      - "8080:80"
    depends_on:
      - db
  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root</code></pre>
                
                <p>Com Docker, você elimina problemas de ambiente e garante consistência entre desenvolvimento e produção!</p>',
                'user_id' => $author3->id,
                'category_id' => $devopsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Kubernetes: Orquestração de Containers na Prática',
                'slug' => 'kubernetes-orquestracao-containers',
                'excerpt' => 'Aprenda a gerenciar containers em escala com Kubernetes, incluindo deployments, services e ingress.',
                'content' => '<h2>Kubernetes: O Padrão para Orquestração</h2>
                <p>Kubernetes se tornou o padrão de fato para orquestração de containers em produção. Vamos explorar seus principais conceitos.</p>
                
                <h3>Componentes Principais</h3>
                <ul>
                    <li><strong>Pods:</strong> Menor unidade, contém um ou mais containers</li>
                    <li><strong>Deployments:</strong> Gerencia réplicas e atualizações</li>
                    <li><strong>Services:</strong> Exposição de aplicações</li>
                    <li><strong>Ingress:</strong> Roteamento HTTP/HTTPS</li>
                </ul>
                
                <h3>Exemplo de Deployment</h3>
                <pre><code>apiVersion: apps/v1
kind: Deployment
metadata:
  name: minha-app
spec:
  replicas: 3
  selector:
    matchLabels:
      app: minha-app
  template:
    metadata:
      labels:
        app: minha-app
    spec:
      containers:
      - name: app
        image: minha-app:latest
        ports:
        - containerPort: 80</code></pre>
                
                <h3>Comandos Kubectl</h3>
                <pre><code>kubectl apply -f deployment.yaml
kubectl get pods
kubectl logs -f pod-name
kubectl scale deployment minha-app --replicas=5</code></pre>
                
                <p>Kubernetes é essencial para aplicações que precisam de alta disponibilidade e escalabilidade!</p>',
                'user_id' => $author3->id,
                'category_id' => $devopsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'CI/CD com GitHub Actions: Automatize Seus Deploys',
                'slug' => 'cicd-github-actions-automatizacao',
                'excerpt' => 'Aprenda a configurar pipelines de CI/CD utilizando GitHub Actions para automatizar testes e deploys.',
                'content' => '<h2>CI/CD com GitHub Actions</h2>
                <p>GitHub Actions revolucionou a forma como fazemos integração e entrega contínua, tudo diretamente no GitHub.</p>
                
                <h3>O que são GitHub Actions?</h3>
                <p>GitHub Actions permite automatizar fluxos de trabalho diretamente no seu repositório, com execução em máquinas virtuais ou containers.</p>
                
                <h3>Exemplo de Pipeline para PHP</h3>
                <pre><code>name: CI/CD Pipeline

on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
    - uses: actions/checkout@v3
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: \'8.2\'
    - name: Install dependencies
      run: composer install
    - name: Run tests
      run: php artisan test
  
  deploy:
    needs: test
    runs-on: ubuntu-latest
    if: github.ref == \'refs/heads/main\'
    steps:
    - name: Deploy to production
      run: |
        echo "Deploying to production..."
        # Adicione seus comandos de deploy aqui</code></pre>
                
                <h3>Benefícios do CI/CD</h3>
                <ul>
                    <li>Testes automatizados em cada push</li>
                    <li>Deploy consistente e rastreável</li>
                    <li>Feedback rápido para desenvolvedores</li>
                    <li>Redução de erros humanos</li>
                </ul>
                
                <p>Implementar CI/CD é essencial para times ágeis e entregas frequentes!</p>',
                'user_id' => $author3->id,
                'category_id' => $devopsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Monitoramento com Prometheus e Grafana',
                'slug' => 'monitoramento-prometheus-grafana',
                'excerpt' => 'Aprenda a monitorar suas aplicações e infraestrutura com Prometheus e Grafana, criando dashboards profissionais.',
                'content' => '<h2>Monitoramento Moderno com Prometheus e Grafana</h2>
                <p>Monitoramento é essencial para garantir a saúde e performance das aplicações. Prometheus e Grafana formam a dupla perfeita.</p>
                
                <h3>Prometheus: Coleta de Métricas</h3>
                <p>Prometheus coleta e armazena métricas de forma eficiente, com um poderoso sistema de consultas (PromQL).</p>
                
                <h3>Configuração Básica</h3>
                <pre><code>global:
  scrape_interval: 15s

scrape_configs:
  - job_name: "meu-app"
    static_configs:
      - targets: ["localhost:8080"]</code></pre>
                
                <h3>Grafana: Visualização</h3>
                <p>Grafana transforma as métricas do Prometheus em dashboards interativos e de fácil interpretação.</p>
                
                <h3>Métricas Importantes</h3>
                <ul>
                    <li>Uso de CPU e Memória</li>
                    <li>Tempo de resposta das APIs</li>
                    <li>Taxa de erros</li>
                    <li>Throughput de requisições</li>
                </ul>
                
                <p>Com Prometheus e Grafana, você tem visibilidade completa da sua aplicação!</p>',
                'user_id' => $author3->id,
                'category_id' => $devopsCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Infraestrutura como Código com Terraform',
                'slug' => 'infraestrutura-codigo-terraform',
                'excerpt' => 'Aprenda a gerenciar sua infraestrutura na nuvem de forma declarativa e versionada com Terraform.',
                'content' => '<h2>Terraform: Infraestrutura como Código</h2>
                <p>Terraform permite definir e provisionar infraestrutura como código, trazendo os benefícios do versionamento para seus recursos de nuvem.</p>
                
                <h3>O que é Terraform?</h3>
                <p>Ferramenta da HashiCorp que permite criar, modificar e versionar infraestrutura de forma segura e previsível.</p>
                
                <h3>Exemplo com AWS</h3>
                <pre><code>provider "aws" {
  region = "us-east-1"
}

resource "aws_instance" "web" {
  ami           = "ami-0c55b159cbfafe1f0"
  instance_type = "t2.micro"
  
  tags = {
    Name = "HelloWorld"
  }
}</code></pre>
                
                <h3>Comandos Essenciais</h3>
                <pre><code>terraform init      # Inicializar projeto
terraform plan      # Verificar mudanças
terraform apply     # Aplicar mudanças
terraform destroy   # Destruir recursos</code></pre>
                
                <h3>Benefícios</h3>
                <ul>
                    <li>Infraestrutura versionada no Git</li>
                    <li>Ambientes consistentes</li>
                    <li>Facilidade para recriação</li>
                    <li>Documentação automática</li>
                </ul>
                
                <p>Infraestrutura como código é fundamental para modernização e agilidade!</p>',
                'user_id' => $author3->id,
                'category_id' => $devopsCategory->id,
                'published_at' => now(),
            ],
        ];

        // ==================== POSTS PARA CATEGORIA BANCO DE DADOS ====================
        $dbPosts = [
            [
                'title' => 'Otimização de Queries MySQL: Guia Prático',
                'slug' => 'otimizacao-queries-mysql-guia',
                'excerpt' => 'Aprenda a identificar e otimizar queries lentas no MySQL, utilizando índices, EXPLAIN e boas práticas.',
                'content' => '<h2>Otimização de Queries no MySQL</h2>
                <p>Queries lentas são um dos principais problemas de performance em aplicações. Vamos aprender técnicas para otimizar suas consultas MySQL.</p>
                
                <h3>Usando EXPLAIN para Analisar Queries</h3>
                <pre><code>EXPLAIN SELECT * FROM usuarios WHERE email = "joao@email.com";</code></pre>
                <p>O comando EXPLAIN mostra como o MySQL executa sua query, identificando gargalos.</p>
                
                <h3>Índices: Acelerando Consultas</h3>
                <pre><code>CREATE INDEX idx_email ON usuarios(email);
CREATE INDEX idx_status_data ON pedidos(status, data_criacao);</code></pre>
                
                <h3>Principais Dicas</h3>
                <ul>
                    <li>Evite SELECT * - selecione apenas campos necessários</li>
                    <li>Use índices em colunas usadas em WHERE e JOIN</li>
                    <li>Evite funções em colunas indexadas no WHERE</li>
                    <li>Normalize dados para evitar redundância</li>
                    <li>Use LIMIT para limitar resultados</li>
                </ul>
                
                <h3>Query Otimizada vs Não Otimizada</h3>
                <pre><code>-- Ruim
SELECT * FROM pedidos WHERE YEAR(data_criacao) = 2024;

-- Bom
SELECT * FROM pedidos 
WHERE data_criacao BETWEEN "2024-01-01" AND "2024-12-31";</code></pre>
                
                <p>Com essas técnicas, você pode melhorar drasticamente a performance do seu banco!</p>',
                'user_id' => $author->id,
                'category_id' => $dbCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'PostgreSQL: Recursos Avançados que Você Precisa Conhecer',
                'slug' => 'postgresql-recursos-avancados',
                'excerpt' => 'Explore os recursos avançados do PostgreSQL, incluindo JSONB, full-text search e extensões poderosas.',
                'content' => '<h2>PostgreSQL: Além do Básico</h2>
                <p>PostgreSQL é um dos bancos mais avançados do mercado. Vamos explorar recursos que vão além do CRUD tradicional.</p>
                
                <h3>Tipo JSONB</h3>
                <pre><code>CREATE TABLE produtos (
    id SERIAL PRIMARY KEY,
    dados JSONB
);

INSERT INTO produtos (dados) VALUES 
(\'{"nome": "Notebook", "preco": 3500, "tags": ["eletrônicos"]}\');

SELECT * FROM produtos 
WHERE dados @> \'{"tags": ["eletrônicos"]}\';</code></pre>
                
                <h3>Full-Text Search</h3>
                <pre><code>CREATE INDEX idx_artigos_busca ON artigos 
USING GIN(to_tsvector(\'portuguese\', titulo || " " || conteudo));

SELECT * FROM artigos 
WHERE to_tsvector(\'portuguese\', titulo || " " || conteudo) 
@@ to_tsquery(\'portuguese\', "banco & dados");</code></pre>
                
                <h3>Extensões Poderosas</h3>
                <ul>
                    <li><strong>PostGIS:</strong> Dados geoespaciais</li>
                    <li><strong>pg_stat_statements:</strong> Estatísticas de queries</li>
                    <li><strong>pg_cron:</strong> Jobs agendados</li>
                </ul>
                
                <p>PostgreSQL oferece recursos de bancos NoSQL dentro de um RDBMS robusto!</p>',
                'user_id' => $author->id,
                'category_id' => $dbCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'NoSQL: MongoDB vs Cassandra vs Redis',
                'slug' => 'nosql-mongodb-cassandra-redis',
                'excerpt' => 'Comparativo entre os principais bancos NoSQL, entenda quando usar cada um e suas características.',
                'content' => '<h2>Escolhendo o Banco NoSQL Ideal</h2>
                <p>Bancos NoSQL são especialistas em diferentes casos de uso. Vamos comparar os principais e entender quando usar cada um.</p>
                
                <h3>MongoDB (Document Store)</h3>
                <p>Ideal para dados semi-estruturados e desenvolvimento ágil.</p>
                <pre><code>db.usuarios.insertOne({
    nome: "João",
    endereco: { cidade: "São Paulo", estado: "SP" },
    habilidades: ["PHP", "JavaScript"]
});</code></pre>
                
                <h3>Cassandra (Wide Column)</h3>
                <p>Excelente para alta escalabilidade e escrita intensiva.</p>
                <pre><code>CREATE TABLE usuarios (
    id UUID PRIMARY KEY,
    nome TEXT,
    email TEXT
);</code></pre>
                
                <h3>Redis (Key-Value/In-Memory)</h3>
                <p>Perfeito para cache, sessões e filas.</p>
                <pre><code>SET usuario:1:online "true"
EXPIRE usuario:1:online 300

# Cache de queries
SET post:123:views 0
INCR post:123:views</code></pre>
                
                <h3>Quando usar cada um?</h3>
                <ul>
                    <li><strong>MongoDB:</strong> Dados variáveis, desenvolvimento rápido</li>
                    <li><strong>Cassandra:</strong> Dados de séries temporais, IoT</li>
                    <li><strong>Redis:</strong> Cache, sessões, contadores, filas</li>
                </ul>
                
                <p>A escolha do banco certo depende do seu caso de uso específico!</p>',
                'user_id' => $author2->id,
                'category_id' => $dbCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Modelagem de Dados: Boas Práticas e Anti-Patterns',
                'slug' => 'modelagem-dados-boas-praticas',
                'excerpt' => 'Aprenda as melhores práticas para modelar bancos de dados relacionais e evite os principais anti-patterns.',
                'content' => '<h2>Modelagem de Dados Eficiente</h2>
                <p>Uma boa modelagem é fundamental para performance e manutenibilidade. Vamos explorar as melhores práticas.</p>
                
                <h3>Formas Normais (1FN, 2FN, 3FN)</h3>
                <p>A normalização evita redundância e anomalias de dados:</p>
                <ul>
                    <li><strong>1FN:</strong> Colunas atômicas, sem valores repetidos</li>
                    <li><strong>2FN:</strong> Dependência total da chave primária</li>
                    <li><strong>3FN:</strong> Sem dependências transitivas</li>
                </ul>
                
                <h3>Anti-Patterns a Evitar</h3>
                <ul>
                    <li><strong>Magic Numbers:</strong> Usar valores fixos no código</li>
                    <li><strong>Entidade-Attribute-Value (EAV):</strong> Flexível, mas muito lento</li>
                    <li><strong>Índices em excesso:</strong> Ajuda SELECT, prejudica INSERT/UPDATE</li>
                    <li><strong>Campos NULL:</strong> Dificultam consultas e índices</li>
                </ul>
                
                <h3>Exemplo Prático</h3>
                <pre><code>-- Ruim: Dados repetidos
CREATE TABLE pedidos (
    id INT,
    cliente_nome VARCHAR(100),
    cliente_email VARCHAR(100),
    produto_nome VARCHAR(100)
);

-- Bom: Normalizado
CREATE TABLE clientes (
    id INT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100)
);

CREATE TABLE produtos (
    id INT PRIMARY KEY,
    nome VARCHAR(100)
);

CREATE TABLE pedidos (
    id INT PRIMARY KEY,
    cliente_id INT REFERENCES clientes(id),
    produto_id INT REFERENCES produtos(id)
);</code></pre>
                
                <p>Uma boa modelagem é a base para um sistema escalável!</p>',
                'user_id' => $author->id,
                'category_id' => $dbCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Migrations e Versionamento de Banco de Dados',
                'slug' => 'migrations-versionamento-banco-dados',
                'excerpt' => 'Aprenda a gerenciar mudanças no banco de dados de forma controlada com migrations e versionamento.',
                'content' => '<h2>Versionamento de Banco de Dados</h2>
                <p>Assim como seu código, o esquema do banco de dados deve ser versionado e evoluído de forma controlada.</p>
                
                <h3>O que são Migrations?</h3>
                <p>Migrations permitem versionar e aplicar mudanças no banco de dados de forma incremental e reversível.</p>
                
                <h3>Exemplo com Laravel</h3>
                <pre><code>php artisan make:migration create_posts_table

// up()
Schema::create("posts", function (Blueprint $table) {
    $table->id();
    $table->string("title");
    $table->text("content");
    $table->timestamps();
});

// down()
Schema::dropIfExists("posts");</code></pre>
                
                <h3>Benefícios</h3>
                <ul>
                    <li>Versionamento junto com o código</li>
                    <li>Ambientes consistentes</li>
                    <li>Histórico de mudanças</li>
                    <li>Rollback seguro</li>
                    <li>Colaboração em equipe</li>
                </ul>
                
                <h3>Ferramentas Populares</h3>
                <ul>
                    <li><strong>Laravel Migrations:</strong> PHP</li>
                    <li><strong>Flyway:</strong> Java/SQL</li>
                    <li><strong>Alembic:</strong> Python</li>
                    <li><strong>Liquibase:</strong> Multi-plataforma</li>
                </ul>
                
                <p>Migrations são essenciais para qualquer projeto profissional!</p>',
                'user_id' => $author3->id,
                'category_id' => $dbCategory->id,
                'published_at' => now(),
            ],
        ];

        // ==================== POSTS PARA CATEGORIA SEGURANÇA ====================
        $securityPosts = [
            [
                'title' => 'OWASP Top 10: Principais Vulnerabilidades e Como Prevenir',
                'slug' => 'owasp-top-10-vulnerabilidades-prevencao',
                'excerpt' => 'Conheça as 10 principais vulnerabilidades de segurança em aplicações web e aprenda como protegê-las.',
                'content' => '<h2>OWASP Top 10: O Guia Definitivo</h2>
                <p>O OWASP Top 10 é o documento mais importante sobre segurança de aplicações web. Vamos explorar as principais vulnerabilidades e como preveni-las.</p>
                
                <h3>1. Injeção (SQL, NoSQL, Command Injection)</h3>
                <p>Use prepared statements e ORM para prevenir injeções SQL.</p>
                <pre><code>// Ruim
$sql = "SELECT * FROM users WHERE email = " . $email;

// Bom
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);</code></pre>
                
                <h3>2. Broken Authentication</h3>
                <p>Implemente autenticação robusta:</p>
                <ul>
                    <li>Use hash forte (bcrypt, Argon2)</li>
                    <li>Implemente 2FA</li>
                    <li>Rate limiting em tentativas de login</li>
                </ul>
                
                <h3>3. Cross-Site Scripting (XSS)</h3>
                <p>Sempre sanitize outputs e use Content Security Policy.</p>
                <pre><code>// Escapar HTML
echo htmlspecialchars($userInput, ENT_QUOTES, "UTF-8");</code></pre>
                
                <h3>4. Cross-Site Request Forgery (CSRF)</h3>
                <p>Use tokens CSRF em formulários.</p>
                <pre><code>&lt;input type="hidden" name="_token" value="{{ csrf_token() }}"&gt;</code></pre>
                
                <h3>5. Exposição de Dados Sensíveis</h3>
                <p>Criptografe dados sensíveis em trânsito (TLS) e em repouso.</p>
                
                <p>Conhecer e prevenir essas vulnerabilidades é essencial para construir aplicações seguras!</p>',
                'user_id' => $author->id,
                'category_id' => $securityCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Autenticação e Autorização: JWT vs OAuth2 vs SAML',
                'slug' => 'autenticacao-autorizacao-jwt-oauth2-saml',
                'excerpt' => 'Comparativo entre os principais protocolos de autenticação e autorização, entenda quando usar cada um.',
                'content' => '<h2>Escolhendo o Protocolo de Autenticação</h2>
                <p>Autenticação e autorização são fundamentais para segurança. Vamos comparar os principais padrões e protocolos.</p>
                
                <h3>JWT (JSON Web Tokens)</h3>
                <p>Tokens auto-contidos, ideais para APIs e microserviços.</p>
                <pre><code>// Criando token
$token = JWT::encode($payload, $secretKey);

// Verificando token
$decoded = JWT::decode($token, $secretKey, ["HS256"]);</code></pre>
                
                <h3>OAuth 2.0</h3>
                <p>Padrão para delegação de acesso, usado por Google, Facebook, etc.</p>
                <pre><code>GET /authorize?
    response_type=code&
    client_id=CLIENT_ID&
    redirect_uri=CALLBACK_URL&
    scope=email%20profile</code></pre>
                
                <h3>SAML (Security Assertion Markup Language)</h3>
                <p>Protocolo baseado em XML, comum em ambientes corporativos e SSO.</p>
                
                <h3>Quando usar cada um?</h3>
                <ul>
                    <li><strong>JWT:</strong> APIs stateless, microserviços</li>
                    <li><strong>OAuth2:</strong> Login social, delegação de acesso</li>
                    <li><strong>SAML:</strong> SSO corporativo, ambientes enterprise</li>
                </ul>
                
                <p>A escolha correta depende da arquitetura e requisitos do seu projeto!</p>',
                'user_id' => $author2->id,
                'category_id' => $securityCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Criptografia: Simétrica vs Assimétrica na Prática',
                'slug' => 'criptografia-simetrica-assimetrica-pratica',
                'excerpt' => 'Entenda as diferenças entre criptografia simétrica e assimétrica e aprenda a implementá-las em suas aplicações.',
                'content' => '<h2>Criptografia: Protegendo Dados Sensíveis</h2>
                <p>Criptografia é fundamental para proteger dados em trânsito e em repouso. Vamos explorar os principais tipos.</p>
                
                <h3>Criptografia Simétrica</h3>
                <p>Uma única chave para cifrar e decifrar (AES, DES).</p>
                <pre><code>// AES-256 com PHP
$chave = "minha-chave-secreta-32bytes";
$dados = "Dados sensíveis";

$cifrado = openssl_encrypt(
    $dados, "aes-256-cbc", $chave, 0, $iv
);
$decifrado = openssl_decrypt(
    $cifrado, "aes-256-cbc", $chave, 0, $iv
);</code></pre>
                
                <h3>Criptografia Assimétrica</h3>
                <p>Par de chaves: pública (cifra) e privada (decifra) - RSA.</p>
                <pre><code>// Gerar par de chaves
$config = [
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
];
$res = openssl_pkey_new($config);
openssl_pkey_export($res, $privKey);
$pubKey = openssl_pkey_get_details($res)["key"];

// Cifrar com chave pública
openssl_public_encrypt($dados, $cifrado, $pubKey);

// Decifrar com chave privada
openssl_private_decrypt($cifrado, $decifrado, $privKey);</code></pre>
                
                <h3>Quando usar cada uma?</h3>
                <ul>
                    <li><strong>Simétrica:</strong> Mais rápida, ideal para grandes volumes</li>
                    <li><strong>Assimétrica:</strong> Mais segura para troca de chaves</li>
                    <li><strong>Híbrido:</strong> Combina ambas (TLS/SSL)</li>
                </ul>
                
                <p>Escolha a criptografia adequada baseado no seu caso de uso!</p>',
                'user_id' => $author3->id,
                'category_id' => $securityCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Segurança em APIs RESTful: Práticas Essenciais',
                'slug' => 'seguranca-apis-restful-praticas',
                'excerpt' => 'Aprenda as melhores práticas para proteger suas APIs RESTful contra as principais ameaças.',
                'content' => '<h2>Protegendo suas APIs RESTful</h2>
                <p>APIs são alvos frequentes de ataques. Vamos implementar as melhores práticas de segurança.</p>
                
                <h3>HTTPS Obrigatório</h3>
                <p>Force HTTPS em toda a comunicação:</p>
                <pre><code># Apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]</code></pre>
                
                <h3>Rate Limiting</h3>
                <p>Prevenir ataques de força bruta e DoS.</p>
                <pre><code>// Laravel Rate Limiting
RateLimiter::for("api", function ($job) {
    return Limit::perMinute(60)->by($job->user()?->id ?: $job->ip());
});</code></pre>
                
                <h3>Validação de Dados</h3>
                <p>Sempre valide e sanitize inputs.</p>
                <pre><code>$validated = $request->validate([
    "email" => "required|email|max:255",
    "age" => "required|integer|min:18",
]);</code></pre>
                
                <h3>Headers de Segurança</h3>
                <pre><code>// CSP (Content Security Policy)
header("Content-Security-Policy: default-src "self"");

// HSTS (HTTP Strict Transport Security)
header("Strict-Transport-Security: max-age=31536000");

// X-Frame-Options
header("X-Frame-Options: DENY");</code></pre>
                
                <h3>CORS Configuração</h3>
                <p>Configure CORS apenas para domínios confiáveis.</p>
                
                <p>Estas práticas são fundamentais para APIs seguras em produção!</p>',
                'user_id' => $author->id,
                'category_id' => $securityCategory->id,
                'published_at' => now(),
            ],
            [
                'title' => 'Boas Práticas de Segurança para Aplicações Laravel',
                'slug' => 'boas-praticas-seguranca-laravel',
                'excerpt' => 'Guia completo de segurança para aplicações Laravel, protegendo contra as principais vulnerabilidades.',
                'content' => '<h2>Laravel Security: O Guia Definitivo</h2>
                <p>Laravel já oferece muitas proteções, mas existem práticas adicionais para garantir segurança máxima.</p>
                
                <h3>Proteções Nativas do Laravel</h3>
                <ul>
                    <li><strong>SQL Injection:</strong> Eloquent e Query Builder usam prepared statements</li>
                    <li><strong>XSS:</strong> Blade escapa automaticamente com {{ }}</li>
                    <li><strong>CSRF:</strong> Tokens automáticos em formulários</li>
                </ul>
                
                <h3>Configurações Importantes</h3>
                <pre><code>// .env
APP_DEBUG=false  # Nunca true em produção
APP_ENV=production
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict</code></pre>
                
                <h3>Autenticação e Autorização</h3>
                <pre><code>// Policies
public function update(User $user, Post $post)
{
    return $user->isAdmin() || $user->id === $post->user_id;
}

// Middleware
Route::middleware(["auth", "can:manage-users"])->group(...);</code></pre>
                
                <h3>Validação Personalizada</h3>
                <pre><code>$request->validate([
    "password" => [
        "required",
        "min:8",
        "regex:/[a-z]/",      // Letra minúscula
        "regex:/[A-Z]/",      // Letra maiúscula
        "regex:/[0-9]/",      // Número
        "regex:/[@$!%*#?&]/", // Caractere especial
    ],
]);</code></pre>
                
                <h3>Logging e Monitoramento</h3>
                <p>Monitore tentativas de login falhas e ações suspeitas.</p>
                
                <p>Laravel oferece uma base sólida, mas a segurança é responsabilidade do desenvolvedor!</p>',
                'user_id' => $author->id,
                'category_id' => $securityCategory->id,
                'published_at' => now(),
            ],
        ];

        // Combinar todos os posts
        $allPosts = array_merge(
            $phpPosts,
            $jsPosts,
            $devopsPosts,
            $dbPosts,
            $securityPosts
        );

        // Inserir todos os posts
        foreach ($allPosts as $post) {
            Post::create($post);
        }
    }
}