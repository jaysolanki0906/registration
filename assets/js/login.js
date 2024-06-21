const form = document.getElementById('form');
        const email = document.getElementById('email');
        const password = document.getElementById('password');

        form.addEventListener('submit', e => {
            e.preventDefault();

            validateInputs();
        });

        email.addEventListener('input', () => {
            validateInputs();
        });

        password.addEventListener('input', () => {
            validateInputs();
        });

        const setError = (element, message) => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');

            errorDisplay.innerText = message;
            inputControl.classList.add('error');
            inputControl.classList.remove('success');

        }

        const setSuccess = element => {
            const inputControl = element.parentElement;
            const errorDisplay = inputControl.querySelector('.error');

            errorDisplay.innerText = '';
            inputControl.classList.add('success');
            inputControl.classList.remove('error');
        };

        const isValidEmail = input => {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            const usernameRe = /^[a-zA-Z0-9._-]+$/;
            return re.test(String(input).toLowerCase()) || usernameRe.test(String(input).toLowerCase());
        }

        const validateInputs = () => {
            const emailValue = email.value.trim();
            const passwordValue = password.value.trim();

            if (emailValue === '') {
                setError(email, 'Email/Username is required!');
            } else if (!isValidEmail(emailValue)) {
                setError(email, 'Provide a valid Email or Username!');
            } else {
                setSuccess(email);
            };
            if (passwordValue === '') {
                setError(password, 'Password is required!');
            } else if (passwordValue.length < 8) {
                setError(password, 'Password must be at least 8 characters');
            } else {
                setSuccess(password);
            }
        };
        const validateForm=()=> {
            form.addEventListener('submit', e => {
                e.preventDefault();
                validateInputs();
                document.getElementById('form').submit();
            });
        };