# 📽️ Plataforma de Streaming de Vídeos Exclusivos por Assinatura 🎬📺🚀

## 🌍 Visão Geral 📌📚

Este repositório contém um projeto de treinamento desenvolvido com Laravel, cujo objetivo é estudar e implementar uma arquitetura concebida em aula. A aplicação consiste em uma API que simula um serviço de streaming de vídeos exclusivos sob demanda, proporcionando um ambiente para a experimentação de técnicas de desenvolvimento e design de sistemas escaláveis e seguros. 🎯🛠️📈

## 🎓 Propósito 📖🔍

Este projeto é destinado exclusivamente a fins acadêmicos e de pesquisa. Ele visa aprofundar o entendimento sobre os desafios e melhores práticas na criação de uma arquitetura robusta para serviços de streaming, utilizando o framework Laravel para o desenvolvimento de uma API. O projeto não possui caráter comercial. 🎯💡📘

## 🔥 Funcionalidades ⚙️📌

- **Cadastro de Usuários:** Registro de novos usuários na plataforma.
- **Assinatura de Planos:** Possibilidade de assinar diferentes planos para acesso aos conteúdos.
- **Reprodução de Vídeos:** Fluxo completo para visualização dos vídeos exclusivos.
- **Gerenciamento de Conteúdos:** Administração de vídeos, incluindo upload, edição e exclusão.
- **Gerenciamento de Assinaturas:** Controle de planos, pagamentos, renovações e histórico de assinaturas.

## 👥 Atores Envolvidos 📋

- **Cliente:** Usuário que se cadastra, adquire um plano de assinatura e acessa os vídeos exclusivos.
- **Administrador de Vídeos:** Responsável pela gestão do catálogo de vídeos.
- **Administrador de Assinaturas:** Gerencia planos, pagamentos e renovações.

## 🏗️ Estrutura da Arquitetura ⚡📊

A implementação deste projeto segue uma arquitetura orientada a eventos e enfatiza os seguintes aspectos:

- **Event Storming:** Técnica utilizada para modelagem e identificação dos eventos que impulsionam as interações do sistema.
- **Escalabilidade:** Preparado para suportar crescimento no número de usuários e conteúdos.
- **Segurança:** Proteção de dados e integridade das informações.
- **Modularidade:** Código estruturado para facilitar manutenção e evolução.
- **Resiliência:** Continuidade da operação mesmo diante de falhas.

## 🖥️ Sobre o Projeto 🔧📂

- **Framework:** Laravel
- **Tipo de Aplicação:** API RESTful
- **Ambiente:** Conteinerizado com Docker

## 🚀 Como Executar o Projeto 📦🔧

### 🐳 Utilizando Docker (Recomendado) ⚡📌

1. **Pré-requisitos:**
   - Docker
   - Docker Compose

2. **Clone o repositório:**
   ```bash
   git clone https://github.com/marcusslv/edu-stream.git
   cd edu-stream
   ```

3. **Criação e inicialização dos contêineres:**
   ```bash
   docker-compose up -d
   ```

4. **Execução das migrations e seeders:**
   ```bash
   docker-compose exec app php artisan migrate --seed
   ```

5. **A API estará disponível em:**
   ```
   http://localhost:8000
   ```

### 🛠️ Execução Manual (Sem Docker) 💾📂

1. **Pré-requisitos:**
   - PHP (versão compatível com Laravel)
   - Composer
   - Banco de dados (MySQL, PostgreSQL, etc.)

2. **Instalação:**
   ```bash
   git clone https://github.com/marcusslv/edu-stream.git
   cd edu-stream
   composer install
   ```

3. **Configuração:**
   - Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente.
   - Execute as migrations e seeders:
     ```bash
     php artisan migrate --seed
     ```

4. **Execução:**
   - Inicie o servidor de desenvolvimento:
     ```bash
     php artisan serve
     ```

## 🎯 Considerações Finais 📢🔍

Este projeto de treinamento é um recurso didático para demonstrar conceitos estudados em aula sobre construção de arquiteturas robustas. A implementação com Laravel, API RESTful, Event Storming e Docker visa aprimorar competências avançadas no design e desenvolvimento de sistemas modernos e escaláveis. 🚀💡🛠️

## 📜 Licença ⚖️🔗

Este projeto está licenciado sob a [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)](LICENSE).


