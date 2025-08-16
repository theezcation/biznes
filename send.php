
<?php
$BOT_TOKEN = '8266251473:AAFQ3_k5PHdSbV2gat8P4yTQbE-oCak4Isc';
$CHAT_ID   = 7498261631; // Chat ID

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $msg   = $_POST['message'] ?? '';

    $text = "📩 Yangi xabar!\n\n👤 Ism: $name\n📧 phone: $phone\n💬 Xabar: $msg";

    $url = "https://api.telegram.org/bot$BOT_TOKEN/sendMessage";

    $data = [
        "chat_id" => $CHAT_ID,
        "text"    => $text,
        "parse_mode" => "HTML"
    ];

    // cURL o‘rniga file_get_contents()
    $options = [
        "http" => [
            "header"  => "Content-type: application/x-www-form-urlencoded\r\n",
            "method"  => "POST",
            "content" => http_build_query($data),
            "timeout" => 10,
        ],
    ];
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo json_encode(["ok"=>false, "error"=>"Telegramga ulanib bo‘lmadi"]);
    } else {
        // Telegramdan qaytgan javobni to‘liq ko‘rsatamiz
        echo $result;
    }
} else {
    echo json_encode(["ok"=>false, "error"=>"Faqat POST so‘rovi mumkin"]);
}
