document.getElementById('login_btn').onclick = async function() {
    const email = document.getElementById('login_email').value;
    const password = document.getElementById('login_password').value;

    const response = await fetch('http://localhost:8000/api/v1/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email, password }),
    });

    const messageDiv = document.getElementById('login_message');
    messageDiv.classList.remove('login-form__message--error');
    messageDiv.classList.remove('login-form__message--success');

    const result = await response.json();

    if (response.ok) {
        messageDiv.textContent = result.message;
        messageDiv.classList.add('login-form__message--success');

        // Save response in local storage
        localStorage.setItem('user', JSON.stringify(result.user));
        
        // Redirect to the specified page after successful login
        window.location.href = 'http://eventmanagement.local/addevent/';
    } else {
        messageDiv.textContent = result.message || 'Login failed.';
        messageDiv.classList.add('login-form__message--error');
    }
};

// BEM-style CSS
const style = document.createElement('style');
style.textContent = `
    .login-form {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        max-width: 400px;
        margin: auto;
        background-color: #f9f9f9;
    }
    .login-form__title {
        margin-bottom: 15px;
    }
    .login-form__input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s;
    }
    .login-form__input:focus {
        border-color: #007bff;
    }
    .login-form__button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    .login-form__button:hover {
        background-color: #0056b3;
    }
    .login-form__message {
        margin-top: 10px;
    }
    .login-form__message--error {
        color: red;
    }
    .login-form__message--success {
        color: green;
    }
`;
document.head.appendChild(style);