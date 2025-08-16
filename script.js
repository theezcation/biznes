const BOT_TOKEN = "8266251473:AAFQ3_k5PHdSbV2gat8P4yTQbE-oCak4Isc"; // tokeningni shu yerga yozasan
const CHAT_ID = "7498261631"; // o‘zingni chat_id yoki kanal_id

document.getElementById("contactForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const name = document.getElementById("name").value;
  const phone = document.getElementById("phone").value;
  const message = document.getElementById("message").value;

  const text = `📩 Yangi xabar:\n👤 Ism: ${name}\n📞 Telefon: ${phone}\n💬 Xabar: ${message}`;

  fetch(`https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      chat_id: CHAT_ID,
      text: text,
      parse_mode: "HTML"
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.ok) {
      document.getElementById("formStatus").textContent = "✅ Xabar yuborildi!";
    } else {
      document.getElementById("formStatus").textContent = "❌ Xatolik: " + data.description;
    }
  })
  .catch(err => {
    document.getElementById("formStatus").textContent = "❌ Internet yoki API xatosi.";
    console.error(err);
  });
});