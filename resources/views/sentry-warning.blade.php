<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Notice</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            color: black;
            background-color: white;
            margin: 0;
            padding: 20px;
        }

        .warning-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        h1 {
            margin-top: 0;
        }

        p {
            line-height: 1.6;
            margin: 1em 0;
        }

        a {
            color: black;
            text-decoration: underline;
        }

        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 20px;
        }

        form {
            display: inline;
        }

        button, .link-button {
            padding: 10px 20px;
            font-size: 16px;
            border: 1px solid black;
            background-color: white;
            color: black;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        button:hover:not(:disabled), .link-button:hover {
            background-color: black;
            color: white;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .checkbox-group {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="warning-container">
        <h1>Frontend Monitoring Notice</h1>

      <p>This environment uses <strong><a href="https://sentry.io">Sentry.io</a></strong> for error tracking and performance monitoring. This means your frontend activity is monitored and sent to Sentry's servers.</p>

        <p><strong>What is monitored?</strong></p>
        <ul>
            <li>Error messages and stack traces</li>
            <li>Browser and device information</li>
            <li>Performance metrics</li>
            <li>Session replays (recordings of user interactions to help debug errors)</li>
        </ul>

        <p>Please review the <a href="https://sentry.io/privacy/" target="_blank" rel="noopener noreferrer">Sentry Privacy Policy</a> to understand how your data is handled.</p>

        <div class="button-group">
            <form action="{{ route('sentry-warning.acknowledge') }}" method="POST">
                @csrf

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" id="acknowledge-checkbox" name="acknowledge" value="1" required>
                        I acknowledge that this application uses Sentry for monitoring
                    </label>
                </div>

                <div class="button-group">
                    <button type="submit" id="continue-btn" disabled>Continue</button>
                    <a href="{{ $liveUrl }}" class="link-button">Go to live site instead</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const checkbox = document.getElementById('acknowledge-checkbox');
        const button = document.getElementById('continue-btn');

        checkbox.addEventListener('change', function() {
            button.disabled = !this.checked;
        });
    </script>
</body>
</html>
