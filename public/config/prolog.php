<?php
require_once getenv('PROJECT_DIR') . '/vendor/autoload.php';

use App\AppContainer;
// Инициализация контейнера приложения(в нем также определяется EntityManager)
AppContainer::init(getenv('PROJECT_DIR'));
