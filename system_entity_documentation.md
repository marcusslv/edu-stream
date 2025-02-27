## System Entity Documentation

### Category (Categoria)

| Attribute   | Description                              | Example                      |
|:------------|:-----------------------------------------|:-----------------------------|
| id          | Unique identifier for the category       | 1                            |
| name        | Name of the category                    | Action                       |
| description | Optional description of the category     | Movies with action scenes    |

---

### Genre (Gênero)

| Attribute   | Description                              | Example                      |
|:------------|:-----------------------------------------|:-----------------------------|
| id          | Unique identifier for the genre          | 1                            |
| name        | Name of the genre                       | Thriller                     |
| description | Optional description of the genre        | Suspenseful movies           |

---

### Cast Member (Membro do Elenco)

| Attribute   | Description                              | Example                      |
|:------------|:-----------------------------------------|:-----------------------------|
| id          | Unique identifier for the cast member    | 1                            |
| name        | Name of the cast member                 | Tom Hanks                    |
| role        | Role of the cast member (actor/director) | Actor                        |
| bio         | Biography of the cast member             | Award-winning actor          |

---

### Video (Vídeo)

| Attribute      | Description                              | Example                      |
|:---------------|:-----------------------------------------|:-----------------------------|
| id             | Unique identifier for the video          | 1                            |
| title          | Title of the video                      | Forrest Gump                 |
| description    | Description of the video                | A man's life story           |
| duration       | Duration of the video                   | 142 minutes                  |
| release_date   | Release date of the video               | 1994-07-06                   |
| rating         | Rating of the video                     | PG-13                        |
| category_id    | Relation to the category                | 1 (Action)                   |
| genre_id       | Relation to the genre                   | 2 (Drama)                    |
| cast_members   | Relation to cast members                | [1, 2] (IDs of cast members) |

---

### Video File (Arquivo de Vídeo)

| Attribute          | Description                                  | Example                           |
|:-------------------|:---------------------------------------------|:----------------------------------|
| id                 | Unique identifier for the video file       | 1                                 |
| video_id           | Relation to the video                        | 1 (Forrest Gump)                  |
| hash               | Unique hash for the video file               | 1234567890                        |
| file_name          | Name of the video file                       | forrest_gump.mp4                  |
| file_original_name | Original name of the video file              | forrest_gump.mp4                  |
| file_size          | Size of the video file                       | 2.5 GB                            |
| file_path          | Path to the video file                       | /path/to/forrest_gump.mp4         |
| file_extension     | Extension of the video file                  | mp4                               |
| created_at         | Creation timestamp                           | 2023-01-01 00:00:00               |
| updated_at         | Last update timestamp                        | 2023-06-15 00:00:00               |

---

### Video Status (Status do Vídeo)

| Attribute | Description                              | Example                      |
|:----------|:-----------------------------------------|:-----------------------------|
| id        | Unique identifier for the video status   | 1                            |
| status    | Name of the video status                 | Available                    |
| details   | Description of the video status          | Video is available for watch |

---

### Catalog (Catálogo)

| Attribute   | Description                       | Example                      |
|:------------|:----------------------------------|:-----------------------------|
| id          | Unique identifier for the catalog | 1                            |
| title       | Title of the catalog              | Best Movies of 2023          |
| description | Description of the catalog        | A collection of top movies   |
| videos      | Relation to videos                | [1, 2, 3] (IDs of videos)    |
| created_at  | Creation timestamp                | 2023-01-01                   |
| updated_at  | Last update timestamp             | 2023-06-15                   |
| user_id     | Relation to the user (optional)   | 5 (User ID)                  |

---

### Plan (Plano)

| Attribute   | Description                              | Example                      |
|:------------|:-----------------------------------------|:-----------------------------|
| id          | Unique identifier for the plan           | 1                            |
| name        | Name of the plan                        | Premium                      |
| description | Description of the plan                 | Access to all content        |
| price       | Price of the plan                       | $9.99                        |
| duration    | Duration of the plan                    | 1 month                      |
| features    | Features included in the plan           | HD, 4 screens                |
| created_at  | Creation timestamp                      | 2023-01-01                   |
| updated_at  | Last update timestamp                   | 2023-06-15                   |

---

### Subscription (Assinatura)

| Attribute       | Description                              | Example                      |
|:----------------|:-----------------------------------------|:-----------------------------|
| id              | Unique identifier for the subscription   | 1                            |
| user_id         | Relation to the user                    | 5 (User ID)                  |
| plan_id         | Relation to the plan                    | 1 (Premium)                  |
| status          | Status of the subscription              | Active                       |
| payment_details | Payment details associated              | Credit card ending in 1234   |
| started_at      | Subscription start timestamp            | 2023-01-01                   |
| ended_at        | Subscription end timestamp (optional)   | N/A                          |

### Subscription Status (Status da Assinatura)

| Status       | Description                                                                 |
|:-------------|:----------------------------------------------------------------------------|
| Active       | The subscription is currently active and the user has access to the services.|
| Inactive     | The subscription is not active, possibly due to non-payment or user cancellation.|
| Pending      | The subscription is awaiting confirmation or payment.                       |
| Cancelled    | The subscription has been cancelled by the user or the system.              |
| Expired      | The subscription has reached its end date and is no longer active.          |
| Suspended    | The subscription is temporarily suspended, possibly due to issues like payment failure.|
| Renewed      | The subscription has been renewed for another term.                         |
| Trial        | The subscription is in a trial period.                                      |
| Grace Period | The subscription is in a grace period after the end date, allowing the user to renew without losing access immediately.|
