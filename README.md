# Laravel SaaS Security & Scaling

<div align="center">
  <p>Elite B2B Security & Production Optimization Configurations for Laravel Applications.</p>
  <p>
    <a href="#-english">🇺🇸 English</a> | 
    <a href="#-português">🇧🇷 Português</a>
  </p>
</div>

---

## 🇺🇸 English

### High-Performance Laravel Infrastructure
This repository contains the official **TAVARDT Agency** hardening templates for corporate SaaS platforms built on the Laravel Framework (PHP). Laravel powers modern web applications, and securing its environment files and asynchronous queues is critical for B2B deployments.

### Contents
- **`nginx-secure.conf`**: Nginx server rules demonstrating the correct Web Root isolation (`/public`). This fundamentally prevents credential leaks (e.g., exposing the `.env` file) and secures backend storage.
- **`SecurityHeadersMiddleware.php`**: A drop-in Laravel Middleware snippet that enforces strict HTTP headers (HSTS, CSP, X-Frame-Options) across the entire application to mitigate XSS and Clickjacking attacks.
- **`deploy-optimize.sh`**: An orchestration script used during CI/CD to aggressively cache application configurations, routes, and views, while gracefully restarting background Queue Workers to ensure zero data loss during code updates.

### Implementation Guide
1. The `nginx-secure.conf` must point `root` exclusively to your Laravel `public/` directory.
2. Ensure you register `SecurityHeadersMiddleware.php` within `app/Http/Kernel.php` for it to take effect globally.
3. The optimization script should be triggered by your deployment pipeline (e.g., GitHub Actions) immediately after a `git pull` or container launch.

### Contact & Services
Looking for elite B2B infrastructure and high-ticket digital engineering?
- **Website:** [ag.tavardt.com](https://ag.tavardt.com/)
- **Email:** contact@tavardt.com

---

## 🇧🇷 Português

### Infraestrutura Laravel de Alta Performance
Este repositório contém os templates oficiais de "Hardening" (blindagem) da **TAVARDT** para plataformas SaaS corporativas construídas sobre o Framework Laravel (PHP). O Laravel impulsiona aplicações web modernas, e proteger seus arquivos de ambiente e filas de processamento assíncrono é crítico para deploys B2B.

### Conteúdo
- **`nginx-secure.conf`**: Regras de Nginx demonstrando o isolamento correto do Web Root (`/public`). Isso previne fundamentalmente vazamentos de credenciais (ex: expor o arquivo `.env`) e protege o armazenamento interno.
- **`SecurityHeadersMiddleware.php`**: Um Snippet de Middleware Laravel *drop-in* que impõe cabeçalhos HTTP estritos (HSTS, CSP, X-Frame-Options) em toda a aplicação para mitigar ataques XSS e Clickjacking.
- **`deploy-optimize.sh`**: Um script de orquestração utilizado durante processos de CI/CD para cachear agressivamente configurações, rotas e *views* da aplicação, reiniciando graciosamente os *Queue Workers* em background para garantir zero perda de dados durante atualizações de código.

### Guia de Implementação
1. O `nginx-secure.conf` deve apontar o `root` exclusivamente para o diretório `public/` do seu Laravel.
2. Certifique-se de registrar o `SecurityHeadersMiddleware.php` dentro de `app/Http/Kernel.php` para que ele tenha efeito global na plataforma.
3. O script de otimização deve ser acionado pelo seu pipeline de deploy (ex: GitHub Actions) imediatamente após um `git pull` ou subida de contêiner.

### Contato & Serviços
Procurando por infraestrutura B2B de elite e engenharia digital high-ticket?
- **Site:** [ag.tavardt.com/br/](https://ag.tavardt.com/br/)
- **E-mail:** contato@tavardt.com
