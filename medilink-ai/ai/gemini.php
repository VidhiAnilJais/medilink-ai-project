<?php

function getAIResponse($prompt){

    $apiKey = "AIzaSyAQzatY3Kxl0AVsEiBXbpLcgSCQPThrbJA";

    $url =
"https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=".$apiKey;
    $data = [

        "contents" => [[

            "parts" => [[

                "text" => $prompt

            ]]

        ]]

    ];

    $payload =
    json_encode($data);

    $ch = curl_init($url);

    curl_setopt($ch,
    CURLOPT_RETURNTRANSFER,
    true);

    curl_setopt($ch,
    CURLOPT_POST,
    true);

    curl_setopt($ch,
    CURLOPT_HTTPHEADER,[

        "Content-Type: application/json"

    ]);

    curl_setopt($ch,
    CURLOPT_POSTFIELDS,
    $payload);

    $response =
    curl_exec($ch);

    curl_close($ch);

    $result =
    json_decode($response,true);

    return $result['candidates'][0]['content']['parts'][0]['text']
    ?? "AI response unavailable.";
}

?>