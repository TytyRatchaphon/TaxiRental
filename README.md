# event-management-project-honey-lemon
Website project devlope by Honey Lemon Team. Dedicated to a Web-tech class.

After clone , cd to the folder you've cloned then in your terminal.

Run these commands
 

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

```bash
cp .env.example .env
```

```bash
sail up -d
```

```bash
sail artisan key:generate
```

```bash
sail artisan migrate
```
If you want some data examples too.. then..

```bash
sail artisan migrate:fresh --seed
```

```bash
sail yarn install
```

```bash
sail yarn dev
```

If you encounter storage not found, try this

```bash
sail artisan storage:link
```
If still that still doesn't do the trick try...

create a storage folder named " storage " in storage (I know it sounds weird)

# Data Examples of how our data looks

```bash
Illuminate\Database\Eloquent\Collection {#7251
    all: [
      App\Models\User {#7262
        id: 3,
        username: "admin",
        email: "admin@example.com",
        email_verified_at: null,
        #password: "$2y$10$7VlprBq7u23LrzkA/WiskOnLfKF2D7POHIh8dynYwLO3WcQD0XLAa",
        user_firstname: "Admin",
        user_lastname: "User",
        user_profile_img: null,
        #remember_token: "U6uVOcHFI6",
        created_at: "2023-08-22 08:16:06",
        updated_at: "2023-08-22 08:16:06",
        deleted_at: null,
        role: "ADMIN",
      },
    ],
  }
[8:19 AM]
all: [
      App\Models\User {#7274
        id: 1,
        username: "user1",
        email: "student1@example.com",
        email_verified_at: null,
        #password: "$2y$10$IfhIk6vKrQW8vllKO81N2.BMXXmsfru/0EYEUUbWDrby2a7PfdGjy",
        user_firstname: "firstname1",
        user_lastname: "lastname1",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:05",
        updated_at: "2023-08-22 08:16:05",
        deleted_at: null,
        role: "STUDENT",
      },
      App\Models\User {#7275
        id: 2,
        username: "user2",
        email: "student2@example.com",
        email_verified_at: null,
        #password: "$2y$10$j4Dji6XctTIsS3KMPlx8heJ2s.xevynybNus3F8UdBjii5tH5Qt2C",
        user_firstname: "firstname2",
        user_lastname: "lastname2",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:05",
        updated_at: "2023-08-22 08:16:05",
        deleted_at: null,
        role: "STUDENT",
      },
      App\Models\User {#7276
        id: 4,
        username: "user3",
        email: "student3@example.com",
        email_verified_at: null,
        #password: "$2y$10$KiOHEXhbTRJuuWczgqBWpuqquRxHFNRDI9mg98rXyuQOXmnj2WtjS",
        user_firstname: "firstname3",
        user_lastname: "lastname3",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:06",
        updated_at: "2023-08-22 08:16:06",
        deleted_at: null,
        role: "STUDENT",
      },
[8:19 AM]
App\Models\User {#7277
        id: 5,
        username: "student4",
        email: "student4@example.com",
        email_verified_at: null,
        #password: "$2y$10$O7FiwLfhNpjAr4qMU8lJrefQrbdJe3Emqwjo4ljB626/Bm1pOCriO",
        user_firstname: "firstname4",
        user_lastname: "lastname4",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:06",
        updated_at: "2023-08-22 08:16:06",
        deleted_at: null,
        role: "STUDENT",
      },
      App\Models\User {#7278
        id: 6,
        username: "student5",
        email: "student5@example.com",
        email_verified_at: null,
        #password: "$2y$10$O4A1/l3sXn6sraaCytobOe5eVEXVaw5hRWUFn0WQbwyQ.BFpSQFIK",
        user_firstname: "firstname5",
        user_lastname: "lastname5",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:06",
        updated_at: "2023-08-22 08:16:06",
        deleted_at: null,
        role: "STUDENT",
      },
all: [
      App\Models\User {#7304
        id: 22,
        username: "operator1",
        email: "operator1@example.com",
        email_verified_at: null,
        #password: "$2y$10$A2rARWCl4K9zUl0uSIIsWu.yYREwCxymJvPXbd.E4nmlxG9g1dQmq",
        user_firstname: "firstname_op1",
        user_lastname: "lastname_op1",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:20",
        updated_at: "2023-08-22 08:16:20",
        deleted_at: null,
        role: "OPERATOR",
      },
      App\Models\User {#7211
        id: 23,
        username: "operator2",
        email: "operator2@example.com",
        email_verified_at: null,
        #password: "$2y$10$Tj.8/Eqr2BhOSR4wO2sf7.5OXPMVGcPeUDEKADl6GV3uosoqYOqou",
        user_firstname: "firstname_op2",
        user_lastname: "lastname_op2",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:20",
        updated_at: "2023-08-22 08:16:20",
        deleted_at: null,
        role: "OPERATOR",
      },
      App\Models\User {#7303
        id: 24,
        username: "operator3",
        email: "operator3@example.com",
        email_verified_at: null,
        #password: "$2y$10$89bbvPXwVpglLFgfzslbN.sXAK37kwz2UmsvTQ.UCOnI2dvA5vZ7u",
        user_firstname: "firstname_op4",
        user_lastname: "lastname_op4",
        user_profile_img: null,
        #remember_token: null,
        created_at: "2023-08-22 08:16:20",
        updated_at: "2023-08-22 08:16:20",
        deleted_at: null,
        role: "OPERATOR",
      },
```
