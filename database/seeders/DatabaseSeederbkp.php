<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Criar usuário Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@mtec.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'bio' => 'Administrador do blog MTec',
            'avatar' => null,
        ]);

        // Criar usuário Autor
        User::create([
            'name' => 'João Silva',
            'email' => 'autor@mtec.com',
            'password' => Hash::make('password123'),
            'role' => 'author',
            'bio' => 'Especialista em PHP e Laravel',
            'avatar' => null,
        ]);

        // Criar categorias iniciais
        $categories = [
            ['name' => 'PHP', 'slug' => 'php', 'description' => 'Artigos sobre PHP e Laravel'],
            ['name' => 'JavaScript', 'slug' => 'javascript', 'description' => 'JavaScript, Node.js e frameworks frontend'],
            ['name' => 'DevOps', 'slug' => 'devops', 'description' => 'Docker, Kubernetes e CI/CD'],
            ['name' => 'Banco de Dados', 'slug' => 'banco-de-dados', 'description' => 'MySQL, PostgreSQL e NoSQL'],
            ['name' => 'Segurança', 'slug' => 'seguranca', 'description' => 'Segurança da informação e boas práticas'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }

        // Criar posts de exemplo
        $posts = [
            [
                'title' => 'Introdução ao Laravel 11',
                'slug' => 'introducao-ao-laravel-11',
                'excerpt' => 'Conheça as principais novidades do Laravel 11 e como começar seus projetos',
                'content' => '<p>Laravel 11 traz diversas melhorias significativas para o framework mais popular do PHP...</p>',
                'user_id' => 2,
                'category_id' => 1,
                'published_at' => now(),
            ],
            [
                'title' => 'JavaScript Assíncrono: Promises e Async/Await',
                'slug' => 'javascript-assincrono-promises-async-await',
                'excerpt' => 'Aprenda a lidar com operações assíncronas em JavaScript de forma elegante',
                'content' => '<p>O JavaScript moderno oferece ferramentas poderosas para programação assíncrona...</p>',
                'user_id' => 2,
                'category_id' => 2,
                'published_at' => now(),
            ],
            [
                'title' => 'Docker para Desenvolvedores',
                'slug' => 'docker-para-desenvolvedores',
                'excerpt' => 'Guia prático para containerizar suas aplicações com Docker',
                'content' => '<p>Docker revolucionou a forma como desenvolvemos e deployamos aplicações...</p>',
                'user_id' => 2,
                'category_id' => 3,
                'published_at' => now(),
            ],
            [
                'title' => 'Introdução ao Laravel 11: Novidades e Primeiros Passos',
                'slug' => 'introducao-ao-laravel-11a',
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
                'user_id' => 2,
                'category_id' => 1,
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
                'user_id' => 2,
                'category_id' => 1,
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
                'user_id' => 2,
                'category_id' => 1,
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
                'user_id' => 2,
                'category_id' => 1,
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
                'user_id' => 2,
                'category_id' => 1,
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
                'user_id' => 2,
                'category_id' => 2,
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
                'user_id' => 2,
                'category_id' => 2,
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
                'user_id' => 2,
                'category_id' => 2,
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
                'user_id' => 2,
                'category_id' => 2,
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
                'user_id' => 2,
                'category_id' => 2,
                'published_at' => now(),
            ],
        ];

        // ==================== POSTS PARA CATEGORIA DEVOPS ====================
        
        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
