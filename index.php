<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

// Replace with your OpenAI API key
$apiKey = getenv('sk-oRvEUhiGK8nyNLCJkBKpPyGJL0hmEj-uaJmAe-VFfoT3BlbkFJ__wayU_ist1NGNCJi6hdkpLLRMxiPRiylM5HslepIA'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['inputText'];

    $response = $client->post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'model' => 'gpt-3.5-turbo',
            'messages' => [['role' => 'user', 'content' => $inputText]],
        ],
    ]);

    $data = json_decode($response->getBody(), true);
    $output = $data['choices'][0]['message']['content'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casper AI Assistant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: #333;
            transition: background-color 0.5s ease;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s;
        }
        h1 {
            text-align: center;
            color: #ff6f61;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        button {
            padding: 10px 15px;
            background-color: #ff6f61;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s; /* Added transform for animation */
        }
        button:hover {
            background-color: #ff4f41;
            transform: scale(1.05); /* Scale effect on hover */
        }
        #output {
            margin-top: 20px;
            padding: 10px;
            background-color: #eaeaea;
            border-radius: 5px;
            overflow-wrap: break-word; /* Ensures long words wrap */
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class='fas fa-lightbulb'></i> Casper AI Assistant</h1>
        
        <form method="POST">
            <textarea name="inputText" placeholder="Enter your text here..." required></textarea>
            
            <button type="submit"><i class='fas fa-paper-plane'></i> Submit</button>
        </form>

        <?php if (isset($output)): ?>
        <div id="output">
           <strong>Response:</strong><br>
           <?php echo nl2br(htmlspecialchars($output)); ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
