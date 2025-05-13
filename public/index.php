<?php require_once __DIR__ . '/../app/routes/dirs.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Innovador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>/app.css">
    <style>
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
