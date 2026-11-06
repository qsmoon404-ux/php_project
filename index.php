<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>МРТ-центр «Магнесия» в Якутске | Диагностика высокого уровня</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* === HEADER === */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .logo span { color: var(--text-dark); }
        nav ul { display: flex; list-style: none; gap: 2rem; }
        nav a { text-decoration: none; color: var(--text-dark); font-weight: 500; transition: color 0.3s; }
        nav a:hover { color: var(--primary); }
        .header-phone { font-weight: 600; color: var(--primary); text-decoration: none; }

        /* === HERO === */
        .hero {
            margin-top: 80px;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            color: var(--white);
            padding: 6rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('https://lit-clinic.ru/upload/images/services/diagnostika/10.webp');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
        }
        .hero-content { position: relative; z-index: 2; max-width: 800px; margin: 0 auto; }
        .hero h1 { font-size: 3rem; margin-bottom: 1.5rem; font-weight: 700; line-height: 1.2; }
        .hero p { font-size: 1.25rem; margin-bottom: 2rem; opacity: 0.9; }
        .btn {
            display: inline-block;
            background: var(--white);
            color: var(--primary);
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }

        /* === АНИМАЦИЯ СКАНИРОВАНИЯ === */
        .scan-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; opacity: 0.3; pointer-events: none; }
        .scan-line {
            position: absolute; left: 0; width: 100%; height: 6px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            box-shadow: 0 0 20px var(--accent), 0 0 40px var(--accent);
            animation: scan 4s linear infinite;
        }
        @keyframes scan {
            0% { top: -10%; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: 110%; opacity: 0; }
        }

        /* === О КЛИНИКЕ === */
        .about-section { padding: 5rem 2rem; background-color: var(--white); }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; max-width: 1200px; margin: 0 auto; align-items: center; }
        .about-text h2 { font-size: 2.5rem; color: var(--text-dark); margin-bottom: 1.5rem; font-weight: 700; }
        .about-text h2 span { color: var(--primary); }
        .about-text p { color: var(--text-gray); margin-bottom: 1.5rem; font-size: 1.1rem; }
        .about-features { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 2rem; }
        .feature-item { display: flex; align-items: flex-start; gap: 1rem; }
        .feature-icon { background: var(--bg-light); color: var(--primary); width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .feature-item h4 { font-size: 1.1rem; margin-bottom: 0.25rem; color: var(--text-dark); }
        .feature-item p { font-size: 0.9rem; color: var(--text-gray); margin: 0; }
        .about-image-placeholder { background: #e3f2fd; border-radius: var(--radius); height: 100%; min-height: 400px; display: flex; align-items: center; justify-content: center; color: var(--primary); text-align: center; padding: 2rem; overflow: hidden; }
        .about-image-placeholder img { width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius); }

        /* === ВРАЧИ === */
        .section {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            color: var(--text-dark);
            margin-bottom: 3rem;
            font-weight: 700;
        }
        .section-title span { color: var(--primary); }
        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .doctor-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .doctor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(21, 101, 192, 0.15);
        }
        .doctor-photo-wrapper {
            width: 100%;
            height: 320px;
            background-color: #e2e8f0;
            position: relative;
            overflow: hidden;
        }
        .doctor-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .photo-placeholder {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-weight: 600;
            background: #edf2f7;
        }
        .doctor-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .doctor-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }
        .doctor-spec {
            color: var(--primary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .doctor-desc {
            color: var(--text-gray);
            font-size: 0.95rem;
            line-height: 1.5;
            flex-grow: 1;
        }
        .doctor-desc ul {
            list-style: none;
            margin-top: 0.5rem;
        }
        .doctor-desc li {
            position: relative;
            padding-left: 1.2rem;
            margin-bottom: 0.5rem;
        }
        .doctor-desc li::before {
            content: "•";
            color: var(--primary);
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        /* === ФОРМА ОБРАТНОЙ СВЯЗИ === */
        .contact-section { background: linear-gradient(to bottom, var(--bg-light), #e3f2fd); padding: 5rem 2rem; }
        .form-container { max-width: 900px; margin: 0 auto; width: 100%; background: var(--white); padding: 3rem; border-radius: var(--radius); box-shadow: 0 20px 40px rgba(21, 101, 192, 0.1); }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .form-group { display: flex; flex-direction: column; }
        .form-group.full-width { grid-column: 1 / -1; }
        .form-group label { font-weight: 500; margin-bottom: 0.5rem; color: var(--text-dark); }
        .form-group input, .form-group textarea { padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; font-family: inherit; transition: border-color 0.3s, box-shadow 0.3s; width: 100%; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.1); }
        .form-group textarea { resize: vertical; min-height: 120px; }
        .submit-btn { background: var(--primary); color: var(--white); padding: 1.2rem; border: none; border-radius: 12px; font-size: 1.1rem; font-weight: 600; cursor: pointer; width: 100%; transition: background 0.3s, transform 0.2s; }
        .submit-btn:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .submit-btn:disabled { background: #cbd5e0; cursor: not-allowed; transform: none; }
        .form-note { text-align: center; font-size: 0.85rem; color: var(--text-gray); margin-top: 1rem; }

        /* НОВОЕ: Стили для чекбокса согласия */
        .consent-label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.95rem;
            color: var(--text-gray);
            cursor: pointer;
            line-height: 1.4;
        }
        .consent-label input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-top: 2px;
            accent-color: var(--primary);
            flex-shrink: 0;
            cursor: pointer;
        }
        .consent-label a {
            color: var(--primary);
            text-decoration: underline;
            font-weight: 600;
        }
        .consent-label a:hover { color: var(--primary-dark); }

        /* НОВОЕ: Секция локальных заявок (Демо) */
        .local-requests {
            max-width: 900px;
            margin: 2rem auto 0;
            background: var(--white);
            padding: 2rem;
            border-radius: var(--radius);
            border: 2px dashed #cbd5e0;
        }
        .local-requests h3 { margin-bottom: 1rem; color: var(--text-dark); }
        .request-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--bg-light);
            border-radius: 12px;
            margin-bottom: 0.8rem;
            border-left: 4px solid var(--primary);
        }
        .request-info strong { display: block; color: var(--text-dark); }
        .request-info span { font-size: 0.9rem; color: var(--text-gray); }
        .delete-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s;
        }
        .delete-btn:hover { background: #dc2626; }

        /* НОВОЕ: Модальное окно Политики конфиденциальности */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            z-index: 2000;
            display: none;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }
        .modal-overlay.active { display: flex; animation: fadeIn 0.3s ease; }
        .modal-content {
            background: var(--white);
            width: 100%;
            max-width: 700px;
            max-height: 85vh;
            border-radius: var(--radius);
            padding: 2.5rem;
            position: relative;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        }
        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--text-gray);
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }
        .modal-close:hover { color: var(--text-dark); }
        .modal-content h2 { color: var(--primary); margin-bottom: 1.5rem; font-size: 1.8rem; }
        .modal-content h3 { color: var(--text-dark); margin: 1.5rem 0 0.5rem; font-size: 1.2rem; }
        .modal-content p, .modal-content li { color: var(--text-gray); font-size: 0.95rem; margin-bottom: 0.8rem; line-height: 1.6; }
        .modal-content ul { padding-left: 1.5rem; }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* === КАРТА === */
        .map-section { padding: 5rem 2rem; background-color: var(--bg-light); }
        .map-container { max-width: 1200px; margin: 0 auto; background: var(--white); border-radius: var(--radius); overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .map-frame { width: 100%; height: 450px; border: none; }
        .map-info { padding: 2rem; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 2rem; text-align: center; }
        .map-info-item h4 { color: var(--primary); margin-bottom: 0.5rem; font-size: 1.1rem; }
        .map-info-item p { color: var(--text-gray); }

        /* === FOOTER === */
        footer { background: var(--text-dark); color: var(--white); padding: 4rem 2rem 2rem; }
        .footer-content { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem; }
        .footer-block h3 { font-size: 1.2rem; margin-bottom: 1.5rem; color: var(--accent); }
        .footer-block p, .footer-block a { color: #cbd5e0; margin-bottom: 0.8rem; display: block; text-decoration: none; transition: color 0.3s; }
        .footer-block a:hover { color: var(--white); }
        .footer-bottom { max-width: 1200px; margin: 3rem auto 0; padding-top: 2rem; border-top: 1px solid #2d3748; text-align: center; color: #718096; font-size: 0.9rem; }

        /* === АДАПТИВНОСТЬ === */
        @media (max-width: 768px) {
            .hero h1 { font-size: 2rem; }
            .nav-container { flex-direction: column; gap: 1rem; }
            nav ul { gap: 1rem; font-size: 0.9rem; }
            .form-grid { grid-template-columns: 1fr; }
            .form-container { padding: 1.5rem; }
            .about-grid { grid-template-columns: 1fr; }
            .about-features { grid-template-columns: 1fr; }
            .map-frame { height: 300px; }
            .modal-content { padding: 1.5rem; }
        }

        /* === АНИМАЦИЯ ПОЯВЛЕНИЯ === */
        .fade-in { opacity: 0; transform: translateY(30px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body>

    <!-- Шапка сайта -->
    <header>
        <div class="nav-container">
            <a href="#" class="logo">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                Магнесия <span>Якутск</span>
            </a>
            <nav>
                <ul>
                    <li><a href="#about">О клинике</a></li>
                    <li><a href="#doctors">Врачи</a></li>
                    <li><a href="#contact">Запись</a></li>
                    <li><a href="#map">Контакты</a></li>
                </ul>
            </nav>
            <a href="tel:+74112318121" class="header-phone">8 (4112) 31-81-21</a>
        </div>
    </header>

    <!-- Главный экран -->
    <section class="hero">
        <div class="scan-container">
            <div class="scan-line"></div>
        </div>
        <div class="hero-content fade-in">
            <h1>Точная МРТ-диагностика в Якутске</h1>
            <p>Современный центр «Магнесия» с квалифицированной командой врачей и оборудованием экспертного класса. Заботимся о вашем здоровье с 2013 года.</p>
            <a href="#contact" class="btn">Записаться на исследование</a>
            <a href="booking.php" style="display:inline-block; padding:15px 30px; background:#2563eb; color:white; text-decoration:none; border-radius:10px; font-weight:bold; margin-left: 10px;">Записаться на приём</a>
        </div>
    </section>

    <!-- О клинике -->
    <section id="about" class="about-section">
        <div class="about-grid fade-in">
            <div class="about-text">
                <h2>О центре <span>«Магнесия»</span></h2>
                <p>Диагностический центр «Магнесия» в Якутске – это современный медицинский центр, оснащенный передовым оборудованием экспертного класса.</p>
                <p>Наши исследования проводятся на современном магнитно-резонансном томографе <strong>Philips Achieva 1,5T SE</strong>, который отличается высокой скоростью сканирования и отличным качеством изображения.</p>
                <div class="about-features">
                    <div class="feature-item">
                        <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
                        <div><h4>Высокая точность</h4><p>Оборудование экспертного класса 1.5 Тесла</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                        <div><h4>Безопасность</h4><p>МРТ не несет лучевой нагрузки на организм</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div>
                        <div><h4>Работа по ОМС и ДМС</h4><p>Принимаем пациентов по полисам страхования</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
                        <div><h4>Удобный график</h4><p>Работаем ежедневно с 7:00 до 23:00</p></div>
                    </div>
                </div>
            </div>
            <div class="about-image-placeholder">
                <img src="https://mrt-kt.info/upload/hlblock/clinics/1432.jpg" alt="Аппарат МРТ Philips Achieva 1,5T SE" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div style="display:none;">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    <h3 style="margin-top: 1rem;">Philips Achieva 1,5T SE</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Врачи (ПОЛНЫЙ СПИСОК) -->
    <section id="doctors" class="section">
        <h2 class="section-title fade-in">Наши <span>специалисты</span></h2>
        <div class="doctors-grid">
            
            <!-- Врач 1 -->
            <div class="doctor-card fade-in">
                <div class="doctor-photo-wrapper">
                    <img src="https://yakutsk.magnesia.su/upload/iblock/cd1/cd12c295fdc53cd35bfb28af1e47462a.jpg" 
                         alt="Дягилева Наталья Евгеньевна" 
                         class="doctor-photo"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="photo-placeholder" style="display:none;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span style="margin-top: 8px; font-size: 0.9rem;">Вставьте ссылку на фото</span>
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">Дягилева Наталья Евгеньевна</h3>
                    <div class="doctor-spec">Врач-рентгенолог</div>
                    <div class="doctor-desc">
                        <ul>
                            <li>Специализация: стандартная МРТ-диагностика</li>
                            <li>Дифференциальный диагноз мультифокальных поражений головного мозга</li>
                            <li>Более 10 лет клинического опыта</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Врач 2 -->
            <div class="doctor-card fade-in">
                <div class="doctor-photo-wrapper">
                    <img src="https://yakutsk.magnesia.su/upload/iblock/de9/zcuyti67d7i60o3yskxgki36jgzglxhd.jpg" 
                         alt="Атласов Андрей Андреевич" 
                         class="doctor-photo"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="photo-placeholder" style="display:none;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span style="margin-top: 8px; font-size: 0.9rem;">Вставьте ссылку на фото</span>
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">Атласов Андрей Андреевич</h3>
                    <div class="doctor-spec">Врач-рентгенолог</div>
                    <div class="doctor-desc">
                        <ul>
                            <li>Специалист по общей врачебной практике и лучевой диагностике</li>
                            <li>Регулярно повышает квалификацию в ведущих институтах лучевой диагностики</li>
                            <li>Внимательный подход к каждому пациенту</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Врач 3 -->
            <div class="doctor-card fade-in">
                <div class="doctor-photo-wrapper">
                    <img src="https://yakutsk.magnesia.su/upload/iblock/e28/e283fb225b4d6ccea0fc18c2f3778031.jpg" 
                         alt="Глебов Антон Сергеевич" 
                         class="doctor-photo"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="photo-placeholder" style="display:none;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span style="margin-top: 8px; font-size: 0.9rem;">Вставьте ссылку на фото</span>
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">Глебов Антон Сергеевич</h3>
                    <div class="doctor-spec">Врач-рентгенолог</div>
                    <div class="doctor-desc">
                        <ul>
                            <li>Участник конгрессов Российского общества рентгенологов и радиологов</li>
                            <li>Специализация: эхопланарные последовательности в диагностике новообразований</li>
                            <li>Международная сертификация</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Врач 4 -->
            <div class="doctor-card fade-in">
                <div class="doctor-photo-wrapper">
                    <img src="https://yakutsk.magnesia.su/upload/iblock/e67/e672f8cbaabf9bf638b6e5d9100c04b4.jpg" 
                         alt="Тимофеев Григорий Константинович" 
                         class="doctor-photo"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="photo-placeholder" style="display:none;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span style="margin-top: 8px; font-size: 0.9rem;">Вставьте ссылку на фото</span>
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">Тимофеев Григорий Константинович</h3>
                    <div class="doctor-spec">Врач-рентгенолог</div>
                    <div class="doctor-desc">
                        <ul>
                            <li>Специализация: стандартная МРТ-диагностика</li>
                            <li>Эксперт в дифференциальном диагнозе поражений вещества головного мозга</li>
                            <li>Постоянное повышение квалификации в центре «Магнесия»</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Врач 5 -->
            <div class="doctor-card fade-in">
                <div class="doctor-photo-wrapper">
                    <img src="https://yakutsk.magnesia.su/upload/iblock/40f/40fe0dfe6af7574d8f5bce46fad5b730.jpg" 
                         alt="Певзнер Светлана Евгеньевна" 
                         class="doctor-photo"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="photo-placeholder" style="display:none;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        <span style="margin-top: 8px; font-size: 0.9rem;">Вставьте ссылку на фото</span>
                    </div>
                </div>
                <div class="doctor-info">
                    <h3 class="doctor-name">Певзнер Светлана Евгеньевна</h3>
                    <div class="doctor-spec">Ведущий врач-рентгенолог</div>
                    <div class="doctor-desc">
                        <ul>
                            <li>Главный консультант по нейрорадиологии и МРТ малого таза</li>
                            <li>Победитель конкурса врачей "Окончательный диагноз"</li>
                            <li>Приглашенный лектор и эксперт международного уровня</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Форма обратной связи -->
    <section id="contact" class="contact-section">
        <div class="form-container fade-in">
            <h2 class="section-title" style="margin-bottom: 2rem; font-size: 2rem;">Записаться на <span>прием</span></h2>
            <form id="contactForm" onsubmit="handleSubmit(event)">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" id="name" name="name" placeholder="Иван Иванов" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <input type="tel" id="phone" name="phone" placeholder="+7 (9XX) XXX-XX-XX" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="service">Интересующая услуга</label>
                        <input type="text" id="service" name="service" placeholder="Например: МРТ головного мозга">
                    </div>
                    <div class="form-group full-width">
                        <label for="message">Комментарий или вопрос</label>
                        <textarea id="message" name="message" placeholder="Опишите вашу ситуацию или удобное время для звонка..."></textarea>
                    </div>
                    
                    <!-- Чекбокс согласия с Политикой конфиденциальности -->
                    <div class="form-group full-width">
                        <label class="consent-label">
                            <input type="checkbox" id="privacyConsent" required>
                            <span>Я согласен с <a href="#" id="openPrivacyModal">политикой конфиденциальности</a> и даю согласие на <a href="#" id="openDataProcessing">обработку моих персональных данных</a> в соответствии с ФЗ-152.</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Отправить заявку</button>
                <p class="form-note">Мы перезвоним вам в течение 15 минут в рабочее время.</p>
            </form>
        </div>

        <!-- Демонстрация сохраненных заявок (Локально в браузере) -->
        <div class="local-requests fade-in" id="localRequestsSection" style="display: none;">
            <h3>📋 Мои сохраненные заявки (Демо-режим)</h3>
            <p style="font-size: 0.9rem; color: var(--text-gray); margin-bottom: 1rem;">Эти данные хранятся только в вашем браузере (localStorage).</p>
            <div id="requestsList"></div>
        </div>
    </section>

    <!-- Карта и адрес -->
    <section id="map" class="map-section">
        <h2 class="section-title fade-in">Как нас <span>найти</span></h2>
        <div class="map-container fade-in">
            <iframe class="map-frame" src="https://yandex.ru/map-widget/v1/?text=Якутск,+ул.+Петровского,+19/5,+Магнесия&z=16" allowfullscreen="true"></iframe>
            <div class="map-info">
                <div class="map-info-item">
                    <h4>📍 Адрес</h4>
                    <p>г. Якутск, ул. Петровского, 19/5</p>
                </div>
                <div class="map-info-item">
                    <h4>📞 Телефон</h4>
                    <p>8 (4112) 31-81-21<br>+7 (958) 111-78-18</p>
                </div>
                <div class="map-info-item">
                    <h4>🕒 Режим работы</h4>
                    <p>Ежедневно: с 7:00 до 23:00</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Подвал -->
    <footer id="contacts-footer">
        <div class="footer-content">
            <div class="footer-block">
                <h3>МРТ-центр «Магнесия»</h3>
                <p>Современная диагностика в Якутске. Квалифицированные врачи и забота о каждом пациенте.</p>
            </div>
            <div class="footer-block">
                <h3>Контакты</h3>
                <p>📍 г. Якутск, ул. Петровского, 19/5</p>
                <a href="tel:+74112318121">📞 8 (4112) 31-81-21</a>
            </div>
            <div class="footer-block">
                <h3>Навигация</h3>
                <a href="#about">О клинике</a>
                <a href="#doctors">Наши врачи</a>
                <a href="#contact">Онлайн-запись</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2026 Диагностический центр «Магнесия». Все права защищены.</p>
        </div>
    </footer>

    <!-- Модальное окно Политики конфиденциальности -->
    <div id="privacyModal" class="modal-overlay">
        <div class="modal-content">
            <button class="modal-close" id="closePrivacyModal">&times;</button>
            <h2>Политика конфиденциальности</h2>
            <p>Настоящая Политика конфиденциальности персональных данных (далее – Политика) действует в отношении всей информации, которую сайт «Магнесия» (далее – Сайт) может получить о Пользователе во время использования сайта.</p>
            
            <h3>1. Общие положения</h3>
            <p>1.1. Использование Пользователем сайта означает согласие с настоящей Политикой и условиями обработки персональных данных Пользователя.</p>
            <p>1.2. В случае несогласия с условиями Политики Пользователь должен прекратить использование сайта.</p>

            <h3>2. Предмет политики конфиденциальности</h3>
            <p>2.1. Настоящая Политика устанавливает обязательства Сайта по неразглашению и обеспечению режима защиты конфиденциальности персональных данных, которые Пользователь предоставляет по запросу при регистрации на сайте или оформлении записи на прием.</p>
            <p>2.2. Персональные данные, разрешённые к обработке в рамках настоящей Политики, предоставляются Пользователем путём заполнения формы обратной связи и включают в себя следующую информацию: имя, номер телефона, комментарий.</p>

            <h3>3. Цели сбора персональной информации</h3>
            <ul>
                <li>Связь с Пользователем для подтверждения записи на прием.</li>
                <li>Предоставление Пользователю эффективной клиентской и технической поддержки.</li>
            </ul>

            <h3>4. Права пользователя</h3>
            <p>Пользователь имеет право на получение информации, касающейся обработки его персональных данных, а также на требование уточнения, блокирования или уничтожения его персональных данных, направив запрос по контактным данным, указанным на сайте.</p>

            <h3>5. Контактная информация</h3>
            <p>По всем вопросам, связанным с обработкой персональных данных, вы можете обратиться по телефону: 8 (4112) 31-81-21 или по адресу: г. Якутск, ул. Петровского, 19/5.</p>
        </div>
    </div>

    <!-- === JAVASCRIPT === -->
    <script>
        // 1. Анимация появления при скролле
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });
        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // 2. Маска для телефона
        document.getElementById('phone').addEventListener('input', function (e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            if (!x[2] && x[1] === '8') { e.target.value = '+7 '; } 
            else { e.target.value = !x[2] ? x[1] : '+' + x[1] + ' (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : ''); }
        });

        // ==========================================
        // ЛОГИКА МОДАЛЬНОГО ОКНА
        // ==========================================
        const modal = document.getElementById('privacyModal');
        const openBtn = document.getElementById('openPrivacyModal');
        const openDataProcessingBtn = document.getElementById('openDataProcessing');
        const closeBtn = document.getElementById('closePrivacyModal');

        const openModal = (e) => {
            e.preventDefault();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        openBtn.addEventListener('click', openModal);
        openDataProcessingBtn.addEventListener('click', openModal);

        const closeModal = () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        };

        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
        });

        // ==========================================
        // ЛОГИКА СОХРАНЕНИЯ ДАННЫХ (localStorage)
        // ==========================================
        const form = document.getElementById('contactForm');
        const formInputs = form.querySelectorAll('input, textarea');
        const DRAFT_KEY = 'magnesia_form_draft';
        const REQUESTS_KEY = 'magnesia_requests';

        // Автосохранение черновика при вводе
        formInputs.forEach(input => {
            input.addEventListener('input', () => {
                const draft = {};
                formInputs.forEach(inp => {
                    if (inp.id) draft[inp.id] = inp.value;
                });
                localStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
            });
        });

        // Загрузка черновика при старте страницы
        window.addEventListener('DOMContentLoaded', () => {
            const draft = JSON.parse(localStorage.getItem(DRAFT_KEY));
            if (draft) {
                formInputs.forEach(inp => {
                    if (inp.id && draft[inp.id]) {
                        inp.value = draft[inp.id];
                    }
                });
            }
            renderRequests();
        });

        // ==========================================
        // === ИСПРАВЛЕННАЯ ФУНКЦИЯ ОТПРАВКИ ===
        // ==========================================
        async function handleSubmit(e) {
            e.preventDefault();
            
            if (!document.getElementById('privacyConsent').checked) {
                alert('Пожалуйста, подтвердите согласие с политикой конфиденциальности.');
                return;
            }

            const btn = e.target.querySelector('.submit-btn');
            const originalText = btn.textContent;
            btn.textContent = 'Отправка...';
            btn.disabled = true;

            // Собираем данные формы
            const formData = {
                name: document.getElementById('name').value,
                phone: document.getElementById('phone').value,
                service: document.getElementById('service').value,
                message: document.getElementById('message').value
            };

            try {
                // ОТПРАВЛЯЕМ ДАННЫЕ НА СЕРВЕР
                const response = await fetch('send.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(formData)
                });

                const result = await response.json();

                if (result.status === 'success') {
                    // Сохраняем локально для демо
                    saveRequestToStorage({
                        id: Date.now(),
                        date: new Date().toLocaleString('ru-RU'),
                        ...formData
                    });
                    
                    localStorage.removeItem(DRAFT_KEY);
                    form.reset();
                    
                    btn.textContent = '✓ Заявка успешно отправлена!';
                    btn.style.background = '#00897b';
                    renderRequests();

                    setTimeout(() => {
                        btn.textContent = originalText;
                        btn.disabled = false;
                        btn.style.background = '';
                    }, 3000);
                } else {
                    alert('Ошибка: ' + result.message);
                    btn.textContent = originalText;
                    btn.disabled = false;
                }
            } catch (error) {
                alert('Ошибка отправки: ' + error.message);
                btn.textContent = originalText;
                btn.disabled = false;
            }
        }

        // Функция сохранения заявки в localStorage
        function saveRequestToStorage(requestData) {
            let requests = JSON.parse(localStorage.getItem(REQUESTS_KEY)) || [];
            requests.push(requestData);
            localStorage.setItem(REQUESTS_KEY, JSON.stringify(requests));
        }

        // Функция отображения списка заявок (Демо)
        function renderRequests() {
            const requests = JSON.parse(localStorage.getItem(REQUESTS_KEY)) || [];
            const listContainer = document.getElementById('requestsList');
            const section = document.getElementById('localRequestsSection');

            if (requests.length === 0) {
                section.style.display = 'none';
                return;
            }

            section.style.display = 'block';
            listContainer.innerHTML = '';

            requests.reverse().forEach(req => {
                const item = document.createElement('div');
                item.className = 'request-item';
                item.innerHTML = `
                    <div class="request-info">
                        <strong>${req.name} | ${req.phone}</strong>
                        <span>Услуга: ${req.service || 'Не указана'} | Дата: ${req.date}</span>
                    </div>
                    <button class="delete-btn" onclick="deleteRequest(${req.id})">Удалить</button>
                `;
                listContainer.appendChild(item);
            });
        }

        // Функция удаления заявки
        window.deleteRequest = function(id) {
            if (!confirm('Вы уверены, что хотите удалить эту запись из истории браузера?')) return;
            
            let requests = JSON.parse(localStorage.getItem(REQUESTS_KEY)) || [];
            requests = requests.filter(req => req.id !== id);
            localStorage.setItem(REQUESTS_KEY, JSON.stringify(requests));
            
            renderRequests();
        };
    </script>
</body>
</html>