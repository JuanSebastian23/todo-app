<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Innovador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #4361ee;
            --secondary-blue: #3f37c9;
            --accent-blue: #4895ef;
            --light-blue: #e7f1ff;
            --gradient-start: #4361ee;
            --gradient-end: #3f37c9;
            --sidebar-width: 280px;
        }

        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .toggle-sidebar {
                display: flex !important;
            }
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .toggle-sidebar {
            display: none !important;
            position: fixed;
            bottom: 2.2rem;
            right: 2.2rem;
            z-index: 1200;
            background: rgba(255,255,255,0.22);
            backdrop-filter: blur(10px);
            color: var(--primary-blue);
            border: 2.5px solid rgba(67, 97, 238, 0.13);
            border-radius: 50%;
            width: 58px;
            height: 58px;
            font-size: 1.5rem;
            box-shadow: 0 8px 32px rgba(67, 97, 238, 0.13), 0 2px 8px rgba(0,0,0,0.08);
            transition: background 0.3s, color 0.3s, box-shadow 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-sidebar.float-in {
            animation: floatIn 0.6s cubic-bezier(0.4,0,0.2,1);
        }

        .toggle-sidebar:hover {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: #fff;
            box-shadow: 0 12px 32px rgba(67, 97, 238, 0.22);
            transform: scale(1.13) rotate(-8deg);
            border: 2.5px solid var(--primary-blue);
        }

        @media (max-width: 768px) {
            body .toggle-sidebar {
                display: flex !important;
                bottom: 1.2rem;
                right: 1.2rem;
                width: 52px;
                height: 52px;
                font-size: 1.2rem;
            }
        }

        @keyframes floatIn {
            0% { opacity: 0; transform: scale(0.7) translateY(40px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        .sidebar-header {
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(67, 97, 238, 0.1);
            margin-bottom: 2rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            color: #666;
            padding: 1rem 1.2rem;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
            overflow: hidden;
            background: rgba(255,255,255,0.18);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.04);
            border: 1.5px solid rgba(255,255,255,0.18);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            transition: all 0.3s ease;
            z-index: -1;
            opacity: 0;
        }

        .nav-link:hover::before, .nav-link.active::before {
            width: 100%;
            opacity: 0.7;
        }

        .nav-link:hover, .nav-link.active {
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 16px rgba(67, 97, 238, 0.10);
            background: rgba(67, 97, 238, 0.18);
            border: 1.5px solid rgba(67, 97, 238, 0.18);
        }

        .task-counter {
            background: rgba(67, 97, 238, 0.1);
            color: var(--primary-blue);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .todo-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .todo-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(67, 97, 238, 0.08), 0 1.5px 8px rgba(0,0,0,0.04);
            border: none;
            padding: 0;
            transition: box-shadow 0.3s cubic-bezier(0.4,0,0.2,1), transform 0.3s cubic-bezier(0.4,0,0.2,1);
            position: relative;
            overflow: visible;
            animation: slideIn 0.5s cubic-bezier(0.4,0,0.2,1);
        }
        .todo-card:hover {
            box-shadow: 0 16px 48px rgba(67, 97, 238, 0.16), 0 2px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px) scale(1.01);
        }
        .todo-item-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem 2rem 1.5rem 2.5rem;
        }
        .priority-indicator {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            border-radius: 50%;
            box-shadow: 0 0 12px 2px rgba(0,0,0,0.08);
            border: 3px solid white;
            z-index: 2;
            animation: popIn 0.5s;
        }
        .priority-high .priority-indicator { background: #ff4d4d; box-shadow: 0 0 16px 2px #ff4d4d44; }
        .priority-medium .priority-indicator { background: #ffd700; box-shadow: 0 0 16px 2px #ffd70044; }
        .priority-low .priority-indicator { background: #4CAF50; box-shadow: 0 0 16px 2px #4CAF5044; }

        .task-checkbox {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2.5px solid var(--primary-blue);
            background: rgba(255,255,255,0.7);
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            position: relative;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08);
            outline: none;
        }
        .task-checkbox:checked {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        .task-checkbox:checked::after {
            content: '\2713';
            position: absolute;
            color: white;
            font-size: 1.1rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1.1);
            font-weight: bold;
            transition: transform 0.2s;
        }
        .task-checkbox:active {
            box-shadow: 0 0 0 4px #4361ee22;
        }
        .todo-details {
            flex: 1;
            min-width: 0;
        }
        .todo-title {
            font-size: 1.18rem;
            font-weight: 700;
            color: #23272f;
            margin-bottom: 0.2rem;
            word-break: break-word;
        }
        .todo-date {
            color: #7b8190;
            font-size: 0.98rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .todo-actions {
            display: flex;
            gap: 0.7rem;
        }
        .btn-action {
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: rgba(255,255,255,0.85);
            border: none;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
            color: var(--primary-blue);
            position: relative;
        }
        .btn-action:hover {
            background: var(--light-blue);
            box-shadow: 0 4px 16px rgba(67, 97, 238, 0.16);
            transform: scale(1.12);
        }
        .btn-action.btn-outline-danger {
            color: #ff4d4d;
        }
        .btn-action.btn-outline-danger:hover {
            background: #ff4d4d11;
        }
        .btn-action.btn-outline-primary {
            color: var(--primary-blue);
        }
        .btn-action.btn-outline-primary:hover {
            background: #4361ee11;
        }
        @media (max-width: 768px) {
            .todo-item-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1.2rem 1rem 1.2rem 2.2rem;
            }
            .todo-title { font-size: 1.05rem; }
            .todo-date { font-size: 0.92rem; }
            .btn-action { width: 38px; height: 38px; font-size: 1.1rem; }
        }
        @media (max-width: 500px) {
            .todo-item-content {
                padding: 1rem 0.5rem 1rem 1.7rem;
            }
            .todo-title { font-size: 0.98rem; }
            .btn-action { width: 34px; height: 34px; font-size: 1rem; }
        }
        @keyframes popIn {
            0% { transform: scale(0.5) translateY(-50%); opacity: 0; }
            100% { transform: scale(1) translateY(-50%); opacity: 1; }
        }

        .btn-add {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
            color: white;
        }

        .todo-item {
            position: relative;
            overflow: hidden;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid rgba(67, 97, 238, 0.2);
            padding: 0.8rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        .search-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .todo-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .todo-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(67, 97, 238, 0.08), 0 1.5px 8px rgba(0,0,0,0.04);
            border: none;
            padding: 0;
            transition: box-shadow 0.3s cubic-bezier(0.4,0,0.2,1), transform 0.3s cubic-bezier(0.4,0,0.2,1);
            position: relative;
            overflow: visible;
            animation: slideIn 0.5s cubic-bezier(0.4,0,0.2,1);
        }
        .todo-card:hover {
            box-shadow: 0 16px 48px rgba(67, 97, 238, 0.16), 0 2px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px) scale(1.01);
        }
        .todo-item-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem 2rem 1.5rem 2.5rem;
        }
        .priority-indicator {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            border-radius: 50%;
            box-shadow: 0 0 12px 2px rgba(0,0,0,0.08);
            border: 3px solid white;
            z-index: 2;
            animation: popIn 0.5s;
        }
        .priority-high .priority-indicator { background: #ff4d4d; box-shadow: 0 0 16px 2px #ff4d4d44; }
        .priority-medium .priority-indicator { background: #ffd700; box-shadow: 0 0 16px 2px #ffd70044; }
        .priority-low .priority-indicator { background: #4CAF50; box-shadow: 0 0 16px 2px #4CAF5044; }

        .task-checkbox {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 2.5px solid var(--primary-blue);
            background: rgba(255,255,255,0.7);
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            position: relative;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08);
            outline: none;
        }
        .task-checkbox:checked {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
        }
        .task-checkbox:checked::after {
            content: '\2713';
            position: absolute;
            color: white;
            font-size: 1.1rem;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1.1);
            font-weight: bold;
            transition: transform 0.2s;
        }
        .task-checkbox:active {
            box-shadow: 0 0 0 4px #4361ee22;
        }
        .todo-details {
            flex: 1;
            min-width: 0;
        }
        .todo-title {
            font-size: 1.18rem;
            font-weight: 700;
            color: #23272f;
            margin-bottom: 0.2rem;
            word-break: break-word;
        }
        .todo-date {
            color: #7b8190;
            font-size: 0.98rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .todo-actions {
            display: flex;
            gap: 0.7rem;
        }
        .btn-action {
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            background: rgba(255,255,255,0.85);
            border: none;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
            color: var(--primary-blue);
            position: relative;
        }
        .btn-action:hover {
            background: var(--light-blue);
            box-shadow: 0 4px 16px rgba(67, 97, 238, 0.16);
            transform: scale(1.12);
        }
        .btn-action.btn-outline-danger {
            color: #ff4d4d;
        }
        .btn-action.btn-outline-danger:hover {
            background: #ff4d4d11;
        }
        .btn-action.btn-outline-primary {
            color: var(--primary-blue);
        }
        .btn-action.btn-outline-primary:hover {
            background: #4361ee11;
        }
        @media (max-width: 768px) {
            .todo-item-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1.2rem 1rem 1.2rem 2.2rem;
            }
            .todo-title { font-size: 1.05rem; }
            .todo-date { font-size: 0.92rem; }
            .btn-action { width: 38px; height: 38px; font-size: 1.1rem; }
        }
        @media (max-width: 500px) {
            .todo-item-content {
                padding: 1rem 0.5rem 1rem 1.7rem;
            }
            .todo-title { font-size: 0.98rem; }
            .btn-action { width: 34px; height: 34px; font-size: 1rem; }
        }
        @keyframes popIn {
            0% { transform: scale(0.5) translateY(-50%); opacity: 0; }
            100% { transform: scale(1) translateY(-50%); opacity: 1; }
        }

        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            border-radius: 16px 16px 0 0;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .todo-card {
            animation: slideIn 0.3s ease-out;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            right: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(67, 97, 238, 0.1);
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(67, 97, 238, 0.1);
            border-radius: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .stats-widget {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 768px) {
            .stats-widget {
                padding: 1.5rem;
            }

            .stats-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .stats-number {
                font-size: 2rem;
            }

            .stats-label {
                font-size: 0.9rem;
            }

            .stats-trend {
                top: 1rem;
                right: 1rem;
                font-size: 0.8rem;
                padding: 0.2rem 0.6rem;
            }
        }

        @media (max-width: 576px) {
            .stats-widget {
                padding: 1.25rem;
            }

            .stats-icon {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
                margin-bottom: 0.75rem;
            }

            .stats-number {
                font-size: 1.75rem;
            }

            .stats-label {
                font-size: 0.85rem;
            }

            .stats-progress {
                height: 4px;
                margin-top: 1rem;
            }

            .stats-chart {
                height: 40px;
            }
        }

        @media (max-width: 400px) {
            .stats-widget {
                padding: 1rem;
            }

            .stats-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                margin-bottom: 0.5rem;
            }

            .stats-number {
                font-size: 1.5rem;
            }

            .stats-label {
                font-size: 0.8rem;
            }

            .stats-trend {
                top: 0.75rem;
                right: 0.75rem;
                font-size: 0.75rem;
                padding: 0.15rem 0.5rem;
            }
        }

        /* Ajustes para pantallas muy grandes */
        @media (min-width: 1400px) {
            .stats-widget {
                padding: 2.5rem;
            }

            .stats-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            .stats-number {
                font-size: 3rem;
            }

            .stats-label {
                font-size: 1.1rem;
            }

            .stats-progress {
                height: 8px;
                margin-top: 2rem;
            }

            .stats-chart {
                height: 80px;
            }
        }

        /* Ajustes para el contenedor principal */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .container {
                padding: 0 1rem;
            }

            .row {
                margin: 0 -0.5rem;
            }

            .col-md-3 {
                padding: 0 0.5rem;
            }
        }

        /* Ajustes para el grid de widgets */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .stats-widget::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
            z-index: 1;
            pointer-events: none;
        }

        .stats-widget:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .stats-icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: inherit;
            border-radius: inherit;
            filter: blur(10px);
            opacity: 0.5;
            z-index: -1;
            transition: all 0.3s ease;
        }

        .stats-widget:hover .stats-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stats-widget:hover .stats-icon::after {
            opacity: 0.8;
            filter: blur(15px);
        }

        .stats-icon.total { 
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            color: white;
        }

        .stats-icon.important { 
            background: linear-gradient(135deg, #ff4d4d, #ff0000);
            color: white;
        }

        .stats-icon.completed { 
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
        }

        .stats-icon.pending { 
            background: linear-gradient(135deg, #ffd700, #ffa500);
            color: white;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #2d3748, #4a5568);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .stats-number::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            border-radius: 2px;
        }

        .stats-label {
            color: #718096;
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.5rem;
        }

        .stats-progress {
            height: 6px;
            background: rgba(67, 97, 238, 0.1);
            border-radius: 3px;
            margin-top: 1.5rem;
            overflow: hidden;
            position: relative;
        }

        .stats-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
            border-radius: 3px;
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stats-progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                90deg,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.3) 50%,
                rgba(255,255,255,0) 100%
            );
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        .stats-widget .stats-trend {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stats-trend.up {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }

        .stats-trend.down {
            background: rgba(244, 67, 54, 0.1);
            color: #f44336;
        }

        .stats-widget .stats-chart {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            opacity: 0.1;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='60' viewBox='0 0 100 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 30 Q 25 20, 50 30 T 100 30' stroke='%234361ee' fill='none' stroke-width='2'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-position: bottom;
            pointer-events: none;
        }

        /* --- Notificaciones y Cerrar Sesión --- */
        .top-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            flex-wrap: wrap;
        }
        @media (max-width: 576px) {
            .top-actions {
                gap: 0.5rem;
            }
            .btn-logout span { display: none; }
            .btn-logout { padding: 0.7rem 0.9rem; font-size: 1.1rem; }
            .btn-notification { width: 40px; height: 40px; font-size: 1.1rem; }
            .btn-add { padding: 0.7rem 1.1rem; font-size: 1rem; }
        }
        .btn-notification {
            position: relative;
            border: none;
            background: rgba(255,255,255,0.85);
            color: var(--primary-blue);
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.08);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s, transform 0.2s;
        }
        .btn-notification:hover {
            background: var(--light-blue);
            color: var(--secondary-blue);
            transform: scale(1.12);
            box-shadow: 0 4px 16px rgba(67, 97, 238, 0.16);
        }
        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 12px;
            height: 12px;
            background: #ff4d4d;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 6px #ff4d4d88;
        }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #f44336, #ff4d4d);
            color: #fff;
            border: none;
            border-radius: 22px;
            padding: 0.7rem 1.3rem;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(244, 67, 54, 0.08);
            transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
            justify-content: center;
            width: 100%;
        }
        .btn-logout:hover {
            background: linear-gradient(135deg, #d32f2f, #ff4d4d);
            box-shadow: 0 4px 16px rgba(244, 67, 54, 0.16);
            transform: translateY(-2px) scale(1.04);
        }
        .notification-dropdown {
            position: absolute;
            top: 120%;
            right: 0;
            min-width: 220px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(67, 97, 238, 0.13);
            border: 1.5px solid rgba(67,97,238,0.08);
            z-index: 3000;
            padding: 0.7rem 0;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s, visibility 0.2s;
        }
        .notification-dropdown.show {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }
        .notification-item {
            padding: 0.7rem 1.2rem;
            font-size: 0.98rem;
            color: #23272f;
            border-bottom: 1px solid #f0f4ff;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background 0.2s;
        }
        .notification-item:last-child { border-bottom: none; }
        .notification-item:hover {
            background: #f0f4ff;
        }
        .notification-empty {
            text-align: center;
            color: #7b8190;
            padding: 1rem 0.5rem;
            font-size: 0.97rem;
        }
    </style>
</head>
<body>
    <!-- Botón Toggle Sidebar -->
    <button class="toggle-sidebar" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3 class="mb-0" style="color: var(--primary-blue);">
                <i class="fas fa-check-circle me-2"></i>
                Mi Todo List
            </h3>
        </div>

        <nav class="nav flex-column">
            <div class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-tasks"></i>
                    Todas las tareas
                    <span class="task-counter">12</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-star"></i>
                    Importantes
                    <span class="task-counter">5</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-check-circle"></i>
                    Completadas
                    <span class="task-counter">3</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-calendar"></i>
                    Calendario
                    <span class="task-counter">8</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar"></i>
                    Estadísticas
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile">
                <div class="user-avatar">JD</div>
                <div>
                    <h6 class="mb-0">Juan Doe</h6>
                    <small class="text-muted">Usuario Premium</small>
                </div>
            </div>
            <button class="btn-logout mt-3" id="logoutBtnSidebar" title="Cerrar sesión">
                <i class="fas fa-sign-out-alt"></i>
                <span class="d-none d-md-inline">Cerrar sesión</span>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h3 mb-0">Mis Tareas</h2>
                        <button class="btn btn-add ms-2" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                            <i class="fas fa-plus me-2"></i>Nueva Tarea
                        </button>
                    </div>

                    <!-- Widgets de Estadísticas -->
                    <div class="stats-grid">
                        <div class="stats-widget">
                            <div class="stats-icon total">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="stats-number">12</div>
                            <div class="stats-label">Total de Tareas</div>
                            <div class="stats-progress">
                                <div class="stats-progress-bar" style="width: 100%"></div>
                            </div>
                            <div class="stats-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>8%</span>
                            </div>
                            <div class="stats-chart"></div>
                        </div>
                        <div class="stats-widget">
                            <div class="stats-icon important">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="stats-number">5</div>
                            <div class="stats-label">Importantes</div>
                            <div class="stats-progress">
                                <div class="stats-progress-bar" style="width: 42%"></div>
                            </div>
                            <div class="stats-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>12%</span>
                            </div>
                            <div class="stats-chart"></div>
                        </div>
                        <div class="stats-widget">
                            <div class="stats-icon completed">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stats-number">3</div>
                            <div class="stats-label">Completadas</div>
                            <div class="stats-progress">
                                <div class="stats-progress-bar" style="width: 25%"></div>
                            </div>
                            <div class="stats-trend down">
                                <i class="fas fa-arrow-down"></i>
                                <span>3%</span>
                            </div>
                            <div class="stats-chart"></div>
                        </div>
                        <div class="stats-widget">
                            <div class="stats-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stats-number">4</div>
                            <div class="stats-label">Pendientes</div>
                            <div class="stats-progress">
                                <div class="stats-progress-bar" style="width: 33%"></div>
                            </div>
                            <div class="stats-trend up">
                                <i class="fas fa-arrow-up"></i>
                                <span>5%</span>
                            </div>
                            <div class="stats-chart"></div>
                        </div>
                    </div>

                    <!-- Filtros -->
                    <div class="search-container">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" placeholder="Buscar tareas...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select">
                                    <option value="">Todas las tareas</option>
                                    <option value="high">Alta prioridad</option>
                                    <option value="medium">Media prioridad</option>
                                    <option value="low">Baja prioridad</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Tareas -->
                    <div class="todo-list">
                        <!-- Tarea 1 -->
                        <div class="card todo-card todo-item priority-high mb-0">
                            <span class="priority-indicator"></span>
                            <div class="todo-item-content">
                                <input type="checkbox" class="task-checkbox me-2">
                                <div class="todo-details">
                                    <div class="todo-title">Completar el proyecto</div>
                                    <div class="todo-date">
                                        <i class="far fa-calendar-alt"></i>
                                        Fecha límite: 15 de Marzo
                                    </div>
                                </div>
                                <div class="todo-actions ms-auto">
                                    <button class="btn btn-action btn-outline-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-action btn-outline-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Tarea 2 -->
                        <div class="card todo-card todo-item priority-medium mb-0">
                            <span class="priority-indicator"></span>
                            <div class="todo-item-content">
                                <input type="checkbox" class="task-checkbox me-2">
                                <div class="todo-details">
                                    <div class="todo-title">Reunión con el equipo</div>
                                    <div class="todo-date">
                                        <i class="far fa-calendar-alt"></i>
                                        Fecha límite: 10 de Marzo
                                    </div>
                                </div>
                                <div class="todo-actions ms-auto">
                                    <button class="btn btn-action btn-outline-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-action btn-outline-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nueva Tarea -->
    <div class="modal fade" id="newTaskModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control" placeholder="Ingresa el título de la tarea">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" rows="3" placeholder="Describe tu tarea"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fecha límite</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prioridad</label>
                            <select class="form-select">
                                <option value="low">Baja</option>
                                <option value="medium">Media</option>
                                <option value="high">Alta</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); border: none;">
                        Guardar Tarea
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        // Animación de entrada solo al cargar
        toggleBtn.classList.add('float-in');
        setTimeout(() => toggleBtn.classList.remove('float-in'), 800);

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });

        // Cerrar sidebar al hacer clic fuera en móviles
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggleBtn.contains(event.target) && 
                sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtnSidebar = document.getElementById('logoutBtnSidebar');
            if (logoutBtnSidebar) {
                logoutBtnSidebar.addEventListener('click', function() {
                    window.location.href = 'app/src/views/auth/login.php';
                });
            }
        });
    </script>
</body>
</html>
