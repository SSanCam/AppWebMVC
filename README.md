# UT04 Proyecto - APP WEB MVC

## 📌 Puesta en marcha
En este ejercicio práctico vas a realizar la implementación de una APP WEB siguiendo el patrón **MVC**, aplicando todas las técnicas vistas hasta ahora.  
Es imprescindible seguir el desarrollo **paso a paso**, para asegurar que la aplicación se construye sobre cimientos sólidos y estables.

La idea de la aplicación web será desarrollar una **réplica personalizada de Instagram**, implementando las siguientes funcionalidades:
- **Login / Registro de usuarios**
- **Publicación de posts**
- **Comentarios**
- **Likes**

---

## ⚙️ Requisitos Técnicos

### **Usuarios (`users`)**
- Los usuarios pueden **registrarse** a través de un formulario.
- Los usuarios pueden **hacer login** a través de un formulario.
- Los usuarios pueden **realizar logout** de la aplicación.
- Los usuarios pueden **eliminar su propio perfil** (darse de baja).
- Un usuario puede **publicar un post**.
- Un usuario puede **eliminar un post propio**.
- Un usuario puede **comentar en un post**.
- Un usuario puede **dar like a un post**.
- Un usuario puede tener **varios posts asociados**.

#### **Estructura de la tabla `users`**
| Campo | Tipo |
|--------|------------|
| id | Clave Primaria (PK) |
| name | String |
| email | String (único) |
| password | String |
| banned | Boolean (por defecto `false`) |
| (Otros campos necesarios para migrations) |

---

### **Publicaciones (`posts`)**
- Un post **pertenece a un único usuario**.
- Un post **puede tener múltiples comentarios**.

#### **Estructura de la tabla `posts`**
| Campo | Tipo |
|--------|------------|
| id | Clave Primaria (PK) |
| title | String |
| description | Text |
| publish_date | Date |
| n_likes | Integer |
| belongs_to | Foreign Key (FK) con `users` |

---

### **Comentarios (`comments`)**
- Un comentario está **asociado a un único post**.
- Un comentario está **asociado a un único usuario**.

#### **Estructura de la tabla `comments`**
| Campo | Tipo |
|--------|------------|
| id | Clave Primaria (PK) |
| comment | Text |
| publish_date | Date |
| user_id | Foreign Key (FK) con `users` |
| post_id | Foreign Key (FK) con `posts` |

---

## 🛠 Requisitos Funcionales

### **1️⃣ Errores de validación**
- Si hay algún error en los datos que introduce el usuario en un formulario, la aplicación debe mostrar **mensajes claros y detallados** para corregirlos.

### **2️⃣ Registro**
- Un usuario podrá registrarse a través de un **formulario en una vista propia**.
- Si el registro es exitoso, el usuario quedará **persistido en la base de datos** y se le redirigirá a la página de **login**.

### **3️⃣ Login**
- Un usuario podrá hacer **login** en la aplicación a través de un formulario en una vista propia.
- Si el login es exitoso, el usuario será **redirigido a la página principal**, que contendrá **todos los posts de la aplicación ordenados por fecha**.

### **4️⃣ Página de posts**
- La página principal contendrá **todos los posts publicados** (propios y de otros usuarios).
- Un usuario podrá **eliminar sus propios posts**.
- Debajo de cada post se mostrará:
  - 📌 **Número de likes** ❤️
  - 💬 **Número de comentarios** ✍️
- Al hacer clic en un post, se redirigirá al usuario a una página de **detalle del post** con todos sus comentarios.
- En la página de detalle, los usuarios podrán **añadir comentarios**.

---

## 📢 Enunciado
Construye una aplicación web siguiendo el **patrón MVC**, asegurando que cumpla con los requisitos técnicos y funcionales descritos anteriormente.

📌 **Requisitos adicionales:**
- La interfaz gráfica debe ser **intuitiva y funcional**.
- Se evaluará el uso correcto de **HTML, CSS y JavaScript**.
- Aunque la interfaz gráfica no es lo más importante, sí se valorará su correcta implementación.

---

## 📦 Conclusión y entrega
Para finalizar el proyecto, se deberá:
1. **Subir el código completo al repositorio de GitHub**.
2. **Generar un archivo `.zip` con el código fuente** y adjuntarlo en la entrega final.

