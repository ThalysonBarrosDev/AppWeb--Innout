<aside class="sidebar">
    <nav class="menu mt-3">
        <ul class="nav-list">
            <li class="nav-item"><a href="day_records.php"><i class="icofont-ui-check mr-2"></i>Registrar Ponto</a></li>
            <li class="nav-item"><a href="monthly_report.php"><i class="icofont-ui-calendar mr-2"></i>Relatório Mensal</a></li>
            <li class="nav-item"><a href="manager_report.php"><i class="icofont-chart-histogram mr-2"></i>Relatório Gerencial</a></li>
            <li class="nav-item"><a href="users.php"><i class="icofont-users mr-2"></i>Usuário</a></li>
        </ul>
    </nav>

    <div class="sidebar-widgets">
        <div class="sidebar-widget">
            <i class="icon icofont-hour-glass text-primary"></i>

            <div class="info">
                <span class="main text-primary" <?= $activeclock === 'workedinterval' ? 'active-clock' : '' ?>><?= $workinginterval; ?></span>
                <span class="label text-mute" >Horas Trabalhadas</span>
            </div>
        </div>

        <div class="division my-3"></div>

        <div class="sidebar-widget">
            <i class="icon icofont-ui-alarm text-danger"></i>

            <div class="info">
                <span class="main text-danger" <?= $activeclock === 'exittime' ? 'active-clock' : '' ?>><?= $exittime; ?></span>
                <span class="label text-mute">Hora de Saída</span>
            </div>
        </div>
    </div>
</aside>