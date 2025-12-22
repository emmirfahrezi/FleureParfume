# API Documentation - Login & Register

## Base URL
```
http://your-domain.com/api
```

## Authentication Endpoints

### 1. Register
Create a new user account.

**Endpoint:** `POST /api/register`

**Request Body:**
```json
{
    "name": "user",
    "email": "user@example.com",
    "password": "password123",
    "role": "user"  
}
```

**Success Response (201):**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "user",
            "email": "user@example.com",
            "role": "user"
        },
        "access_token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "token_type": "Bearer"
    }
}
```

**Error Response (422):**
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "email": ["The email has already been taken."]
    }
}
```

---

### 2. Login
Authenticate a user and receive an access token.

**Endpoint:** `POST /api/login`

**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**Success Response (200):**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "user",
            "email": "user@example.com",
            "role": "user"
        },
        "access_token": "2|xxxxxxxxxxxxxxxxxxxxxxxxxxx",
        "token_type": "Bearer"
    }
}
```

**Error Response (401):**
```json
{
    "success": false,
    "message": "Invalid credentials"
}
```

---

### 3. Logout
Revoke the current access token.

**Endpoint:** `POST /api/logout`

**Headers:**
```
Authorization: Bearer {your_access_token}
```

**Success Response (200):**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

---

### 4. Get User
Get authenticated user information.

**Endpoint:** `GET /api/user`

**Headers:**
```
Authorization: Bearer {your_access_token}
```

**Success Response (200):**
```json
{
    "success": true,
    "data": {
        "user": {
            "id": 1,
            "name": "user",
            "email": "user@example.com",
            "role": "user"
        }
    }
}
```

---

## Using the API

### With cURL

**Register:**
```bash
curl -X POST http://your-domain.com/api/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "user",
    "email": "user@example.com",
    "password": "password123"
  }'
```

**Login:**
```bash
curl -X POST http://your-domain.com/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "user@example.com",
    "password": "password123"
  }'
```

**Get User (Protected):**
```bash
curl -X GET http://your-domain.com/api/user \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Accept: application/json"
```

**Logout (Protected):**
```bash
curl -X POST http://your-domain.com/api/logout \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -H "Accept: application/json"
```

### With JavaScript (Axios)

```javascript
// Register
const register = async () => {
  try {
    const response = await axios.post('/api/register', {
      name: 'user',
      email: 'user@example.com',
      password: 'password123'
    });
    
    // Save token to localStorage
    localStorage.setItem('token', response.data.data.access_token);
    console.log('Registered:', response.data);
  } catch (error) {
    console.error('Error:', error.response.data);
  }
};

// Login
const login = async () => {
  try {
    const response = await axios.post('/api/login', {
      email: 'user@example.com',
      password: 'password123'
    });
    
    // Save token to localStorage
    localStorage.setItem('token', response.data.data.access_token);
    console.log('Logged in:', response.data);
  } catch (error) {
    console.error('Error:', error.response.data);
  }
};

// Get User (with authentication)
const getUser = async () => {
  try {
    const token = localStorage.getItem('token');
    const response = await axios.get('/api/user', {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    
    console.log('User:', response.data);
  } catch (error) {
    console.error('Error:', error.response.data);
  }
};

// Logout
const logout = async () => {
  try {
    const token = localStorage.getItem('token');
    const response = await axios.post('/api/logout', {}, {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    
    // Remove token from localStorage
    localStorage.removeItem('token');
    console.log('Logged out:', response.data);
  } catch (error) {
    console.error('Error:', error.response.data);
  }
};
```

## Notes

- All protected endpoints require the `Authorization: Bearer {token}` header
- Tokens are created using Laravel Sanctum
- The token should be stored securely (e.g., localStorage, sessionStorage, or secure cookie)
- The `Accept: application/json` header is recommended for all requests
- Default role is "user" if not specified during registration
