# Domains

Este diretório contém a lógica específica do domínio para a aplicação. Cada domínio é organizado em subdiretórios para 
contextos, agregados, entidades, repositórios, serviços e objetos de valor.

## Estrutura

```
App\Domains
├── Contexts
│   ├── Domain
│   │   └── Aggregates
│   │   └── Entities
│   │   └── Repositories
│   │   └── Services
│   │   └── ValueObjects
```

### Contextos

- **Domain**
    - **Aggregates**: Contém raízes de agregados que encapsulam entidades e objetos de valor.
    - **Entities**: Define as entidades principais e seus relacionamentos.
    - **Repositories**: Interfaces e implementações para acesso e persistência de dados.
    - **Services**: Contém a lógica de negócios e serviços de domínio.
    - **ValueObjects**: Objetos imutáveis que representam aspectos descritivos do domínio.

Cada contexto segue essa estrutura para manter uma separação clara de responsabilidades e promover modularidade 
e reutilização.
