<?php
session_start();
require_once 'users.php';

$DATA_FILE = "zapisi.txt";

// === ОБРАБОТКА ДЕЙСТВИЙ ===

// Выход
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Удаление заявки (только админ)
if (isset($_GET['delete']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $line_to_delete = (int)$_GET['delete'];
    if (file_exists($DATA_FILE)) {
        $lines = file($DATA_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (isset($lines[$line_to_delete])) {
            unset($lines[$line_to_delete]);
            file_put_contents($DATA_FILE, implode(PHP_EOL, array_values($lines)) . PHP_EOL, LOCK_EX);
        }
    }
    header("Location: admin.php?tab=records");
    exit;
}

// Назначение врача к заявке (только админ)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_doctor']) && $_SESSION['role'] === 'admin') {
    $line_index = (int)$_POST['line_index'];
    $doctor_login = trim($_POST['doctor_login']);
    
    if (file_exists($DATA_FILE)) {
        $lines = file($DATA_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (isset($lines[$line_index])) {
            $parts = explode(" | ", $lines[$line_index]);
            // Формат: Имя | Телефон | Дата | Услуга | Комментарий | Врач | Желаемое время
            // Если частей меньше 7 — дополняем
            while (count($parts) < 7) {
                $parts[] = '—';
            }
            $parts[5] = $doctor_login; // Назначаем врача (по логину)
            $lines[$line_index] = implode(" | ", $parts);
            file_put_contents($DATA_FILE, implode(PHP_EOL, $lines) . PHP_EOL, LOCK_EX);
        }
    }
    header("Location: admin.php?tab=records");
    exit;
}

// Добавление пользователя (только админ)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user']) && $_SESSION['role'] === 'admin') {
    $login = trim($_POST['new_login']);
    $pass = trim($_POST['new_pass']);
    $name = trim($_POST['new_name']);
    $role = trim($_POST['new_role']);
    $filter_raw = trim($_POST['new_filter'] ?? '');
    
    if ($login && $pass && $name && $role && !isset($USERS[$login])) {
        $user = ['pass' => $pass, 'role' => $role, 'name' => $name];
        if ($role === 'doctor' && $filter_raw) {
            $user['filter'] = array_map('trim', explode(',', $filter_raw));
        }
        $USERS[$login] = $user;
        saveUsers($USERS);
    }
    header("Location: admin.php?tab=users");
    exit;
}

// Удаление пользователя (только админ, нельзя удалить себя и admin)
if (isset($_GET['delete_user']) && $_SESSION['role'] === 'admin') {
    $user_to_delete = trim($_GET['delete_user']);
    if ($user_to_delete !== 'admin' && $user_to_delete !== $_SESSION['login']) {
        unset($USERS[$user_to_delete]);
        saveUsers($USERS);
    }
    header("Location: admin.php?tab=users");
    exit;
}

// === ОБРАБОТКА ВХОДА ===
$error_msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $login = trim($_POST['login']);
    $pass = trim($_POST['password']);
    
    if (isset($USERS[$login]) && $USERS[$login]['pass'] === $pass) {
        $_SESSION['logged_in'] = true;
        $_SESSION['role'] = $USERS[$login]['role'];
        $_SESSION['user_name'] = $USERS[$login]['name'];
        $_SESSION['login'] = $login;
        $_SESSION['user_filter'] = $USERS[$login]['filter'] ?? [];
        header("Location: admin.php");
        exit;
    } else {
        $error_msg = "Неверный логин или пароль";
    }
}

$is_logged = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$tab = $_GET['tab'] ?? 'records';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>МРТ Клиника — Панель управления</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
    font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
    background-color: #f0f4f8;
    background-image: radial-gradient(#d0e1f9 1px, transparent 1px);
    background-size: 20px 20px;
    color: #1e293b;
    min-height: 100vh;
    padding: 40px 20px;
}
.wrapper { width: 100%; max-width: 1200px; margin: 0 auto; }

.login-box {
    background: #ffffff; max-width: 400px; margin: 10vh auto 0;
    padding: 40px; border-radius: 20px;
    box-shadow: 0 10px 40px rgba(44, 82, 130, 0.1);
    border-top: 6px solid #3b82f6;
}
.login-box h2 { color: #1e3a8a; text-align: center; margin-bottom: 8px; font-size: 24px; }
.login-box p { color: #64748b; text-align: center; font-size: 14px; margin-bottom: 24px; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px; }
.form-group input, .form-group select, .form-group textarea {
    width: 100%; padding: 14px; border: 2px solid #e2e8f0;
    border-radius: 10px; font-size: 15px; transition: all 0.3s;
    background: #f8fafc; font-family: inherit;
}
.form-group input:focus, .form-group select:focus, .form-group textarea:focus {
    outline: none; border-color: #3b82f6; background: #fff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}
.btn {
    width: 100%; padding: 14px; border: none; border-radius: 10px;
    background: #2563eb; color: white; font-size: 16px;
    font-weight: 600; cursor: pointer; transition: background 0.3s;
}
.btn:hover { background: #1d4ed8; }
.btn-sm { width: auto; padding: 8px 14px; font-size: 13px; }
.btn-green { background: #10b981; }
.btn-green:hover { background: #059669; }
.btn-red { background: #ef4444; }
.btn-red:hover { background: #dc2626; }
.btn-gray { background: #64748b; }
.btn-gray:hover { background: #475569; }
.alert {
    padding: 12px; background: #fee2e2; color: #b91c1c;
    border-radius: 8px; text-align: center; margin-top: 15px; font-size: 14px;
}
.hint-box {
    background: #eff6ff; border: 1px dashed #93c5fd; color: #1e40af;
    padding: 12px; border-radius: 8px; font-size: 12px; margin-top: 20px; line-height: 1.6;
}
.hint-box b { color: #1e3a8a; }

.dashboard-header {
    background: #ffffff; padding: 24px 32px; border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); margin-bottom: 24px;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 15px; border-left: 6px solid #3b82f6;
}
.dashboard-header h1 { font-size: 22px; color: #1e3a8a; margin-bottom: 4px; }
.user-info { font-size: 14px; color: #64748b; margin-top: 4px; }
.user-info b { color: #2563eb; }
.role-badge {
    display: inline-block; padding: 4px 10px; border-radius: 20px;
    font-size: 12px; font-weight: 600; margin-left: 10px;
}
.role-admin { background: #fee2e2; color: #b91c1c; }
.role-operator { background: #e0e7ff; color: #3730a3; }
.role-doctor { background: #dcfce7; color: #166534; }

.stats { display: flex; align-items: center; gap: 15px; }
.counter-badge {
    background: #eff6ff; color: #1d4ed8; padding: 10px 20px;
    border-radius: 10px; font-weight: 700; font-size: 16px;
    border: 1px solid #bfdbfe; display: flex; align-items: center; gap: 8px;
}
.counter-badge span { font-size: 22px; }
.btn-logout {
    color: #ef4444; text-decoration: none; font-size: 14px;
    font-weight: 600; padding: 10px 16px; border: 1px solid #fecaca;
    border-radius: 10px; transition: 0.2s; background: #fef2f2;
}
.btn-logout:hover { background: #fee2e2; }

/* Вкладки */
.tabs {
    display: flex; gap: 10px; margin-bottom: 24px; flex-wrap: wrap;
}
.tab-link {
    padding: 12px 24px; background: #ffffff; border-radius: 12px;
    text-decoration: none; color: #475569; font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05); transition: all 0.3s;
    border: 2px solid transparent;
}
.tab-link:hover { border-color: #3b82f6; color: #2563eb; }
.tab-link.active { background: #2563eb; color: white; }

.table-card {
    background: #ffffff; border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); overflow: hidden;
}
table { width: 100%; border-collapse: collapse; min-width: 900px; }
th {
    background: #f8fafc; color: #475569; text-align: left;
    padding: 16px 20px; font-size: 12px; text-transform: uppercase;
    letter-spacing: 0.5px; border-bottom: 1px solid #e2e8f0;
}
td {
    padding: 14px 20px; border-bottom: 1px solid #f1f5f9;
    color: #334155; font-size: 14px; vertical-align: middle;
}
tr:last-child td { border-bottom: none; }
tr:hover td { background: #f8fafc; }
.td-name { font-weight: 600; color: #0f172a; }
.td-phone { color: #2563eb; font-weight: 500; white-space: nowrap; }
.td-phone a { color: inherit; text-decoration: none; }
.td-phone a:hover { text-decoration: underline; }
.td-comment { color: #475569; font-style: italic; max-width: 200px; }
.td-doctor { font-weight: 600; color: #059669; }
.td-date { white-space: nowrap; color: #64748b; font-size: 13px; }

.btn-delete {
    background: #ef4444; color: white; border: none;
    padding: 6px 12px; border-radius: 6px; cursor: pointer;
    font-size: 12px; text-decoration: none; transition: background 0.2s;
}
.btn-delete:hover { background: #dc2626; }

.empty-state { padding: 60px 20px; text-align: center; color: #94a3b8; }
.empty-state h3 { color: #64748b; margin-bottom: 8px; font-size: 18px; }

/* Карточки пользователей */
.users-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px; padding: 24px;
}
.user-card {
    background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;
    padding: 20px; position: relative;
}
.user-card .user-role {
    display: inline-block; padding: 3px 10px; border-radius: 12px;
    font-size: 11px; font-weight: 600; margin-bottom: 10px;
}
.user-card .user-name { font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
.user-card .user-login { font-size: 13px; color: #64748b; font-family: monospace; }
.user-card .user-pass { font-size: 12px; color: #94a3b8; margin-top: 4px; }
.user-card .user-filter { font-size: 12px; color: #059669; margin-top: 8px; font-style: italic; }
.user-card .user-actions {
    margin-top: 12px; display: flex; gap: 8px;
}
.user-card .user-actions a {
    font-size: 12px; padding: 6px 12px; border-radius: 6px;
    text-decoration: none; color: white;
}
.user-card .user-actions .del { background: #ef4444; }
.user-card .user-actions .del:hover { background: #dc2626; }

.add-user-form {
    background: #ffffff; border-radius: 16px; padding: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05); margin-bottom: 24px;
    border-left: 6px solid #10b981;
}
.add-user-form h3 { color: #059669; margin-bottom: 16px; font-size: 18px; }
.form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; }

.assign-form { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; }
.assign-form select { padding: 6px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; }

@media (max-width: 768px) {
    .dashboard-header { flex-direction: column; align-items: flex-start; padding: 20px; }
    .stats { width: 100%; justify-content: space-between; }
    th, td { padding: 10px 12px; font-size: 13px; }
    .form-row { grid-template-columns: 1fr; }
}
</style>
</head>
<body>
<div class="wrapper">
<?php if (!$is_logged): ?>
    <div class="login-box">
        <h2>Вход в систему</h2>
        <p>Введите логин и пароль</p>
        <form method="POST">
            <div class="form-group">
                <label>Логин</label>
                <input type="text" name="login" placeholder="admin, operator или фамилия" required autofocus>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn">Войти</button>
        </form>
        <?php if (!empty($error_msg)): ?>
            <div class="alert"><?php echo $error_msg; ?></div>
        <?php endif; ?>
        <div class="hint-box">
            <b>Подсказка для входа:</b><br>
            🔴 Админ: <code>admin</code> / <code>mri2025</code><br>
            🔵 Оператор: <code>operator</code> / <code>operator2026</code><br>
            🟢 Врачи: <code>dyagileva</code>, <code>atlasov</code>, <code>glebov</code>, <code>timofeev</code>, <code>pevzner</code> / <code>doc123</code>
        </div>
    </div>
<?php else: ?>
    <?php
    // === ЧТЕНИЕ И ФИЛЬТРАЦИЯ ДАННЫХ ===
    $lines = [];
    if (file_exists($DATA_FILE)) {
        $lines = file($DATA_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
    
    $role = $_SESSION['role'];
    $filter = $_SESSION['user_filter'] ?? [];
    $my_login = $_SESSION['login'];
    
    $role_title = $role === 'admin' ? 'Администратор' : ($role === 'operator' ? 'Оператор' : 'Врач');
    $role_class = "role-$role";
    
    // Фильтрация для врачей
    $display_lines = [];
    $line_index = 0;
    foreach ($lines as $line) {
        $parts = explode(" | ", $line);
        if (count($parts) >= 3) {
            if ($role === 'doctor') {
                $assigned_doctor = $parts[5] ?? '—';
                $service = $parts[3] ?? '';
                $comment = $parts[4] ?? '';
                $full_text = mb_strtolower($service . ' ' . $comment, 'UTF-8');
                
                // Показываем если: назначен этому врачу ИЛИ совпадают ключевые слова
                $by_assignment = ($assigned_doctor === $my_login);
                $by_filter = false;
                if (!empty($filter)) {
                    foreach ($filter as $keyword) {
                        if (mb_strpos($full_text, mb_strtolower($keyword, 'UTF-8')) !== false) {
                            $by_filter = true;
                            break;
                        }
                    }
                }
                
                if (!$by_assignment && !$by_filter) {
                    $line_index++;
                    continue;
                }
            }
            $display_lines[] = ['index' => $line_index, 'parts' => $parts];
        }
        $line_index++;
    }
    $total = count($display_lines);
    ?>
    
    <div class="dashboard-header">
        <div>
            <h1>Панель управления</h1>
            <div class="user-info">
                Вы вошли как: <b><?php echo htmlspecialchars($_SESSION['user_name']); ?></b>
                <span class="role-badge <?php echo $role_class; ?>"><?php echo $role_title; ?></span>
            </div>
        </div>
        <div class="stats">
            <div class="counter-badge">
                <span><?php echo $total; ?></span> заявок
            </div>
            <a href="?logout=1" class="btn-logout">Выйти</a>
        </div>
    </div>

    <?php if ($role === 'admin'): ?>
    <!-- Вкладки только для админа -->
    <div class="tabs">
        <a href="?tab=records" class="tab-link <?php echo $tab === 'records' ? 'active' : ''; ?>">📋 Заявки</a>
        <a href="?tab=users" class="tab-link <?php echo $tab === 'users' ? 'active' : ''; ?>">👥 Пользователи</a>
    </div>
    <?php endif; ?>

    <?php if ($role === 'admin' && $tab === 'users'): ?>
        <!-- === ВКЛАДКА ПОЛЬЗОВАТЕЛИ === -->
        
        <!-- Форма добавления -->
        <div class="add-user-form">
            <h3>➕ Добавить нового пользователя</h3>
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Логин (латиницей)</label>
                        <input type="text" name="new_login" placeholder="ivanov" required>
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="text" name="new_pass" placeholder="••••••••" required>
                    </div>
                    <div class="form-group">
                        <label>Имя / ФИО</label>
                        <input type="text" name="new_name" placeholder="Иванов И.И." required>
                    </div>
                    <div class="form-group">
                        <label>Роль</label>
                        <select name="new_role" id="roleSelect" required>
                            <option value="doctor">🟢 Врач</option>
                            <option value="operator">🔵 Оператор</option>
                        </select>
                    </div>
                    <div class="form-group" id="filterGroup" style="grid-column: 1 / -1;">
                        <label>Ключевые слова для фильтра (через запятую) — только для врачей</label>
                        <input type="text" name="new_filter" placeholder="головного мозга, малого таза">
                    </div>
                </div>
                <button type="submit" name="add_user" class="btn btn-green" style="width:auto; margin-top:10px;">Добавить пользователя</button>
            </form>
        </div>

        <!-- Список пользователей -->
        <div class="table-card">
            <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
                <h3 style="color:#1e3a8a;">Список пользователей системы</h3>
            </div>
            <div class="users-grid">
            <?php foreach ($USERS as $login => $user): ?>
                <?php
                $u_role = $user['role'];
                $u_role_title = $u_role === 'admin' ? 'Администратор' : ($u_role === 'operator' ? 'Оператор' : 'Врач');
                $u_role_class = "role-$u_role";
                $u_role_bg = $u_role === 'admin' ? '#fee2e2;color:#b91c1c' : ($u_role === 'operator' ? '#e0e7ff;color:#3730a3' : '#dcfce7;color:#166534');
                $filter_text = isset($user['filter']) ? implode(', ', $user['filter']) : '';
                $can_delete = ($login !== 'admin' && $login !== $my_login);
                ?>
                <div class="user-card">
                    <span class="user-role" style="background:<?php echo $u_role_bg; ?>"><?php echo $u_role_title; ?></span>
                    <div class="user-name"><?php echo htmlspecialchars($user['name']); ?></div>
                    <div class="user-login">Логин: <?php echo htmlspecialchars($login); ?></div>
                    <div class="user-pass">Пароль: <?php echo htmlspecialchars($user['pass']); ?></div>
                    <?php if ($filter_text): ?>
                        <div class="user-filter">🔍 Фильтр: <?php echo htmlspecialchars($filter_text); ?></div>
                    <?php endif; ?>
                    <?php if ($can_delete): ?>
                        <div class="user-actions">
                            <a href="?delete_user=<?php echo urlencode($login); ?>" class="del" onclick="return confirm('Удалить пользователя <?php echo htmlspecialchars($user['name']); ?>?')">🗑 Удалить</a>
                        </div>
                    <?php else: ?>
                        <div class="user-actions" style="color:#94a3b8; font-size:12px;">
                            <?php echo $login === 'admin' ? '🔒 Системный аккаунт' : '👤 Это вы'; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            </div>
        </div>

    <?php else: ?>
        <!-- === ВКЛАДКА ЗАЯВКИ (для всех ролей) === -->
        <div class="table-card">
        <?php if ($total === 0): ?>
            <div class="empty-state">
                <h3>Нет доступных записей</h3>
                <p><?php echo $role === 'doctor' ? 'По вашей специализации пока нет заявок.' : 'Пациенты пока не оставляли заявок.'; ?></p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Пациент</th>
                        <th>Телефон</th>
                        <th>Услуга</th>
                        <th>Комментарий</th>
                        <th>Назначенный врач</th>
                        <th>Желаемое время</th>
                        <th>Дата заявки</th>
                        <?php if ($role === 'admin'): ?><th>Действия</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                $n = 1;
                foreach ($display_lines as $item) {
                    $p = $item['parts'];
                    $name = htmlspecialchars($p[0] ?? '—');
                    $phone = htmlspecialchars($p[1] ?? '—');
                    $date = htmlspecialchars($p[2] ?? '—');
                    
                    if (count($p) === 3) {
                        $service = '—'; $comment = '—'; $doctor = '—'; $preferred = '—';
                        if (preg_match('/\(Услуга:\s*(.+?)\)/u', $p[2], $m)) {
                            $service = htmlspecialchars($m[1]);
                            $date = htmlspecialchars(preg_replace('/\s*\(Услуга:.*$/u', '', $p[2]));
                        }
                    } else {
                        $service = htmlspecialchars($p[3] ?? 'Не указана');
                        $comment = htmlspecialchars($p[4] ?? 'Без комментария');
                        $doctor_login = $p[5] ?? '—';
                        $preferred = htmlspecialchars($p[6] ?? '—');
                        
                        // Показываем имя врача вместо логина
                        if ($doctor_login !== '—' && isset($USERS[$doctor_login])) {
                            $doctor = htmlspecialchars($USERS[$doctor_login]['name']);
                        } else {
                            $doctor = htmlspecialchars($doctor_login);
                        }
                    }
                    
                    echo "<tr>";
                    echo "<td>{$n}</td>";
                    echo "<td class='td-name'>{$name}</td>";
                    echo "<td class='td-phone'><a href='tel:{$phone}'>{$phone}</a></td>";
                    echo "<td>{$service}</td>";
                    echo "<td class='td-comment'>{$comment}</td>";
                    
                    if ($role === 'admin') {
                        // Форма назначения врача
                        echo "<td>";
                        echo "<form method='POST' class='assign-form'>";
                        echo "<input type='hidden' name='line_index' value='{$item['index']}'>";
                        echo "<select name='doctor_login'>";
                        echo "<option value='—'>— Не назначен —</option>";
                        foreach ($USERS as $ulogin => $udata) {
                            if ($udata['role'] === 'doctor') {
                                $selected = (isset($doctor_login) && $doctor_login === $ulogin) ? 'selected' : '';
                                echo "<option value='{$ulogin}' {$selected}>" . htmlspecialchars($udata['name']) . "</option>";
                            }
                        }
                        echo "</select>";
                        echo "<button type='submit' name='assign_doctor' class='btn btn-green btn-sm'>✓</button>";
                        echo "</form>";
                        echo "</td>";
                    } else {
                        echo "<td class='td-doctor'>{$doctor}</td>";
                    }
                    
                    echo "<td>{$preferred}</td>";
                    echo "<td class='td-date'>{$date}</td>";
                    
                    if ($role === 'admin') {
                        echo "<td><a href='?delete={$item['index']}&tab=records' class='btn-delete' onclick=\"return confirm('Удалить запись пациента {$name}?')\">Удалить</a></td>";
                    }
                    echo "</tr>";
                    $n++;
                }
                ?>
                </tbody>
            </table>
        <?php endif; ?>
        </div>
    <?php endif; ?>

<?php endif; ?>
</div>

<script>
// Показывать поле фильтра только для врачей
document.getElementById('roleSelect')?.addEventListener('change', function() {
    const filterGroup = document.getElementById('filterGroup');
    if (this.value === 'doctor') {
        filterGroup.style.display = 'block';
    } else {
        filterGroup.style.display = 'none';
    }
});
</script>
</body>
</html>