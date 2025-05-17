<!-- Chatbot UI -->
<div id="botui-app" style="display: none; position: fixed; bottom: 100px; right: 30px; z-index: 999;">
    <bot-ui></bot-ui>
</div>
<!-- Footer Section -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <span class="contact-label">CUSTOMER SERVICE</span>
            <p>We Are Available From Monday To Sunday To Assist Any Way</p>
            <p>Call Us On +9425 5462314</p>
        </div>
        <div class="footer-section">
            <span class="contact-label">CONTACT US</span>
            <p>Need To Get In Touch? Just Send Us An Email At</p>
            <p>Ninenty6@Gmail.Com</p>
        </div>
    </div>
    
    <div class="social-media">
        <p>Follow us</p>
        <span>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
        </span>
    </div>

    <div class="footer-bottom">
        <p>Copyright © 2025 <b>Ninety6 Fashion</b>. All Rights Reserved</p>
        <p>Ninety6. Powered by SyntaxSphere</p>
        <img src="assets/imgs/pic17.png" alt="Payment Methods">
    </div>
</footer>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chatbot Floating Button -->
<button id="chat-toggle" style="position: fixed; bottom: 30px; right: 30px; background-color: #000; color: #fff; border-radius: 50%; width: 60px; height: 60px; font-size: 24px; z-index: 1000;">
    💬
</button>


<!-- Chatbot Script -->
<script>
    const chatToggle = document.getElementById('chat-toggle');
    const botuiApp = document.getElementById('botui-app');
    const botui = new BotUI('botui-app');

    let chatOpened = false;

    chatToggle.addEventListener('click', function () {
        chatOpened = !chatOpened;
        botuiApp.style.display = chatOpened ? 'block' : 'none';

        if (chatOpened) {
            botui.message.add({
                content: 'Hi there! How can I help you today? 🛍️'
            }).then(function () {
                return botui.action.button({
                    delay: 500,
                    action: [
                        { text: 'Track Order', value: 'track' },
                        { text: 'View Discounts', value: 'discounts' },
                        { text: 'Contact Support', value: 'support' }
                    ]
                });
            }).then(function (res) {
                if (res.value === 'track') {
                    botui.message.add({ content: 'Please enter your order ID below 👇' });
                } else if (res.value === 'discounts') {
                    botui.message.add({ content: 'Our current discounts: 10% off on handbags, 15% off for students!' });
                } else if (res.value === 'support') {
                    botui.message.add({ content: 'You can contact us at support@ninety6.com or call +94-XXX-XXXXXX' });
                }
            });
        }
    });
</script>

</body>
</html>
