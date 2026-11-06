<?php
// Простая защита от прямого доступа к служебным файлам
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Запись на приём — МРТ-центр «Магнесия»</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
    --primary: #1565c0;
    --primary-dark: #0d47a1;
    --accent: #00e5ff;
    --bg-light: #f8fbff;
    --text-dark: #1a202c;
    --text-gray: #4a5568;
    --white: #ffffff;
    --radius: 24px;
}
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    font-family: 'Inter', sans-serif;
    color: var(--text-dark);
    background: linear-gradient(135deg, #e3f2fd 0%, #f8fbff 100%);
    min-height: 100vh;
    padding: 2rem 1rem;
}
.container { max-width: 900px; margin: 0 auto; }

/* Шапка */
.top-bar {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
}
.back-link {
    color: var(--primary); text-decoration: none; font-weight: 600;
    display: flex; align-items: center; gap: 6px;
    padding: 10px 18px; background: var(--white); border-radius: 50px;
    box-shadow: 0 4px 12px rgba(21, 101, 192, 0.1);
    transition: all 0.3s;
}
.back-link:hover { transform: translateX(-4px); box-shadow: 0 6px 16px rgba(21, 101, 192, 0.15); }
.phone-link { color: var(--primary); font-weight: 600; text-decoration: none; }

/* Заголовок */
.page-title {
    text-align: center; margin-bottom: 2rem;
}
.page-title h1 {
    font-size: 2.5rem; color: var(--text-dark); margin-bottom: 0.5rem;
}
.page-title h1 span { color: var(--primary); }
.page-title p { color: var(--text-gray); font-size: 1.1rem; }

/* Форма */
.form-card {
    background: var(--white); padding: 3rem; border-radius: var(--radius);
    box-shadow: 0 20px 40px rgba(21, 101, 192, 0.1);
}
.form-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;
}
.form-group { display: flex; flex-direction: column; }
.form-group.full-width { grid-column: 1 / -1; }
.form-group label {
    font-weight: 500; margin-bottom: 0.5rem; color: var(--text-dark); font-size: 0.95rem;
}
.form-group label .required { color: #ef4444; }
.form-group input,
.form-group select,
.form-group textarea {
    padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px;
    font-size: 1rem; font-family: inherit; transition: all 0.3s;
    width: 100%; background: var(--white);
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none; border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.1);
}
.form-group textarea { resize: vertical; min-height: 100px; }

/* Карточки врачей */
.doctor-selector {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 0.75rem; margin-top: 0.5rem;
}
.doctor-option {
    position: relative; cursor: pointer;
}
.doctor-option input { position: absolute; opacity: 0; }
.doctor-option .card {
    padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px;
    text-align: center; transition: all 0.3s; background: var(--bg-light);
}
.doctor-option .card .name {
    font-weight: 600; font-size: 0.9rem; color: var(--text-dark);
    margin-bottom: 0.25rem;
}
.doctor-option .card .spec {
    font-size: 0.75rem; color: var(--text-gray);
}
.doctor-option input:checked + .card {
    border-color: var(--primary); background: #e3f2fd;
    box-shadow: 0 4px 12px rgba(21, 101, 192, 0.15);
}
.doctor-option:hover .card { border-color: var(--primary); }

/* Чекбокс согласия */
.consent-label {
    display: flex; align-items: flex-start; gap: 12px;
    font-size: 0.9rem; color: var(--text-gray); cursor: pointer; line-height: 1.4;
}
.consent-label input { width: 20px; height: 20px; accent-color: var(--primary); flex-shrink: 0; }
.consent-label a { color: var(--primary); text-decoration: underline; }

/* Кнопка */
.submit-btn {
    background: var(--primary); color: var(--white);
    padding: 1.2rem; border: none; border-radius: 12px;
    font-size: 1.1rem; font-weight: 600; cursor: pointer;
    width: 100%; transition: all 0.3s; margin-top: 1rem;
}
.submit-btn:hover { background: var(--primary-dark); transform: translateY(-2px); }
.submit-btn:disabled { background: #cbd5e0; cursor: not-allowed; transform: none; }

/* Сообщение об успехе */
.success-message {
    display: none; text-align: center; padding: 3rem 2rem;
}
.success-message.show { display: block; }
.success-icon {
    width: 80px; height: 80px; background: #10b981; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.5rem; color: white; font-size: 2.5rem;
}
.success-message h2 { color: var(--text-dark); margin-bottom: 0.5rem; }
.success-message p { color: var(--text-gray); margin-bottom: 1.5rem; }

/* Адаптивность */
@media (max-width: 600px) {
    .form-grid { grid-template-columns: 1fr; }
    .form-card { padding: 1.5rem; }
    .page-title h1 { font-size: 1.8rem; }
    .doctor-selector { grid-template-columns: 1fr 1fr; }
}
</style>
</head>
<body>
<div class="container">
    <div class="top-bar">
        <a href="index.html" class="back-link">← На главную</a>
        <a href="tel:+74112318121" class="phone-link">📞 8 (4112) 31-81-21</a>
    </div>

    <div class="page-title">
        <h1>Запись на <span>приём</span></h1>
        <p>Выберите врача и удобное время — мы перезвоним для подтверждения</p>
    </div>

    <div class="form-card">
        <!-- ФОРМА -->
        <form id="bookingForm">
            <div class="form-grid">
                <div class="form-group">
                    <label>Ваше имя <span class="required">*</span></label>
                    <input type="text" id="name" name="name" placeholder="Иван Иванов" required>
                </div>
                <div class="form-group">
                    <label>Телефон <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
                </div>

                <!-- Выбор врача -->
                <div class="form-group full-width">
                    <label>Выберите врача</label>
                    <div class="doctor-selector">
                        <label class="doctor-option">
                            <input type="radio" name="doctor" value="Дягилева Н.Е.">
                            <div class="card">
                                <div class="name">Дягилева Н.Е.</div>
                                <div class="spec">МРТ головного мозга</div>
                            </div>
                        </label>
                        <label class="doctor-option">
                            <input type="radio" name="doctor" value="Атласов А.А.">
                            <div class="card">
                                <div class="name">Атласов А.А.</div>
                                <div class="spec">Общая диагностика</div>
                            </div>
                        </label>
                        <label class="doctor-option">
                            <input type="radio" name="doctor" value="Глебов А.С.">
                            <div class="card">
                                <div class="name">Глебов А.С.</div>
                                <div class="spec">Онкодиагностика</div>
                            </div>
                        </label>
                        <label class="doctor-option">
                            <input type="radio" name="doctor" value="Тимофеев Г.К.">
                            <div class="card">
                                <div class="name">Тимофеев Г.К.</div>
                                <div class="spec">МРТ мозга</div>
                            </div>
                        </label>
                        <label class="doctor-option">
                            <input type="radio" name="doctor" value="Певзнер С.Е.">
                            <div class="card">
                                <div class="name">Певзнер С.Е.</div>
                                <div class="spec">МРТ малого таза</div>
                            </div>
                        </label>
                        <label class="doctor-option">
                            <input type="radio" name="doctor" value="Не важно" checked>
                            <div class="card">
                                <div class="name">Любой врач</div>
                                <div class="spec">На усмотрение клиники</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Услуга / исследование</label>
                    <input type="text" id="service" name="service" placeholder="МРТ головного мозга">
                </div>
                <div class="form-group">
                    <label>Желаемая дата и время</label>
                    <input type="datetime-local" id="preferred_date" name="preferred_date">
                </div>

                <div class="form-group full-width">
                    <label>Комментарий</label>
                    <textarea id="message" name="message" placeholder="Опишите симптомы или задайте вопрос..."></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="consent-label">
                        <input type="checkbox" id="consent" required>
                        <span>Согласен с <a href="index.html#contact">политикой конфиденциальности</a> и обработкой персональных данных (ФЗ-152).</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Отправить заявку</button>
        </form>

        <!-- Сообщение об успехе -->
        <div class="success-message" id="successMessage">
            <div class="success-icon">✓</div>
            <h2>Заявка отправлена!</h2>
            <p>Мы перезвоним вам в течение 15 минут в рабочее время.<br>Спасибо, что выбрали «Магнесию»!</p>
            <a href="index.html" class="back-link" style="display:inline-flex;">← Вернуться на главную</a>
        </div>
    </div>
</div>

<script>
// Маска телефона
document.getElementById('phone').addEventListener('input', function (e) {
    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
    if (!x[2] && x[1] === '8') { e.target.value = '+7 '; }
    else { e.target.value = !x[2] ? x[1] : '+' + x[1] + ' (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : ''); }
});

// Установка минимальной даты — сегодня
const dateInput = document.getElementById('preferred_date');
const now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
dateInput.min = now.toISOString().slice(0, 16);

// Отправка формы
document.getElementById('bookingForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = e.target.querySelector('.submit-btn');
    const originalText = btn.textContent;
    btn.textContent = 'Отправка...';
    btn.disabled = true;

    // Собираем данные
    const doctorRadio = document.querySelector('input[name="doctor"]:checked');
    const formData = {
        name: document.getElementById('name').value,
        phone: document.getElementById('phone').value,
        service: document.getElementById('service').value,
        message: document.getElementById('message').value,
        doctor: doctorRadio ? doctorRadio.value : 'Не выбран',
        preferred_date: document.getElementById('preferred_date').value || 'Не указана'
    };

    try {
        const response = await fetch('send.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(formData)
        });
        const result = await response.json();

        if (result.status === 'success') {
            e.target.style.display = 'none';
            document.getElementById('successMessage').classList.add('show');
        } else {
            alert('Ошибка: ' + result.message);
            btn.textContent = originalText;
            btn.disabled = false;
        }
    } catch (error) {
        alert('Ошибка сети: ' + error.message);
        btn.textContent = originalText;
        btn.disabled = false;
    }
});
</script>
</body>
</html>