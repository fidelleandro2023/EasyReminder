<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleEditor = Role::where('name', 'editor')->first();
        $roleUser = Role::where('name', 'user')->first();

        $menus = [
            [
                'name' => 'Menus',
                'url' => '#',
                'icon' => 'fas fa-bars',
                'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 1,
                'children' => [
                    [
                        'name' => 'Crear Menú',
                        'url' => str_replace(url('/'), '', route('menus.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Menú',
                        'url' => str_replace(url('/'), '', route('menus.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Roles',
                'url' => '#',
                'icon' => 'fas fa-user-tag',
                'roles' => json_encode([$roleAdmin->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 2,
                'children' => [
                    [
                        'name' => 'Crear Rol',
                        'url' => str_replace(url('/'), '', route('roles.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Roles',
                        'url' => str_replace(url('/'), '', route('roles.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Permisos',
                'url' => '#',
                'icon' => 'fas fa-lock',
                'roles' => json_encode([$roleAdmin->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 3,
                'children' => [
                    [
                        'name' => 'Crear Permiso',
                        'url' => str_replace(url('/'), '', route('permissions.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Permisos',
                        'url' => str_replace(url('/'), '', route('permissions.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Recordatorios',
                'url' => '#',
                'icon' => 'fas fa-wallet',
                'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 4,
                'children' => [
                    [
                        'name' => 'Crear Recordatorio',
                        'url' => str_replace(url('/'), '', route('reminders.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Recordatorios',
                        'url' => str_replace(url('/'), '', route('reminders.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Presupuesto',
                'url' => '#',
                'icon' => 'fas fa-wallet',
                'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 4,
                'children' => [
                    [
                        'name' => 'Crear Presupuesto',
                        'url' => str_replace(url('/'), '', route('budgets.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Presupuestos',
                        'url' => str_replace(url('/'), '', route('budgets.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Análisis de gastos',
                'url' => '#',
                'icon' => 'fas fa-chart-pie',
                'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                'permissions' => json_encode(['view','edit']),
                'order' => 5,
                'children' => [
                    [
                        'name' => 'Crear análisis de gastos',
                        'url' => str_replace(url('/'), '', route('expense.analysis.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar análisis de gastos',
                        'url' => str_replace(url('/'), '', route('expense.analysis')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Historial de pagos',
                'url' => '#',
                'icon' => 'fas fa-history',
                'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                'permissions' => json_encode(['view']),
                'order' => 6,
                'children' => [
                    [
                        'name' => 'Crear historial de pagos',
                        'url' => str_replace(url('/'), '', route('payment_histories.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar historial de pagos',
                        'url' => str_replace(url('/'), '', route('payment_histories')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Pagos',
                'url' => '#',
                'icon' => 'fas fa-credit-card',
                'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 7,
                'children' => [
                    [
                        'name' => 'Crear Pago',
                        'url' => str_replace(url('/'), '', route('payments.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Pagos',
                        'url' => str_replace(url('/'), '', route('payments.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Pagos recurrentes',
                'url' => '#',
                'icon' => 'fas fa-wallet',
                'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 8,
                'children' => [
                    [
                        'name' => 'Crear Pago Recurrente',
                        'url' => str_replace(url('/'), '', route('recurring_payments.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Pagos Recurrentes',
                        'url' => str_replace(url('/'), '', route('recurring_payments.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Servicios',
                'url' => '#',
                'icon' => 'fas fa-building',
                'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 9,
                'children' => [
                    [
                        'name' => 'Crear Entidad de Servicio',
                        'url' => str_replace(url('/'), '', route('service_entities.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Entidades de Servicio',
                        'url' => str_replace(url('/'), '', route('service_entities.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id, $roleUser->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Usuarios',
                'url' => '#',
                'icon' => 'fas fa-users',
                'roles' => json_encode([$roleAdmin->id]),
                'permissions' => json_encode(['create', 'view']),
                'order' => 10,
                'children' => [
                    [
                        'name' => 'Crear Usuario',
                        'url' => str_replace(url('/'), '', route('users.create')),
                        'icon' => 'fas fa-plus',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['create']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Listar Usuarios',
                        'url' => str_replace(url('/'), '', route('users.index')),
                        'icon' => 'fas fa-list',
                        'roles' => json_encode([$roleAdmin->id]),
                        'permissions' => json_encode(['view']),
                        'order' => 2,
                    ],
                ],
            ],
            [
                'name' => 'Ayuda',
                'url' => '#',
                'icon' => 'fas fa-question-circle',
                'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                'permissions' => json_encode(['view']),
                'order' => 3,
                'children' => [
                    [
                                'name' => 'Documentación',
                                'url' => str_replace(url('/'), '', route('help_guides.index')),
                                'icon' => 'fas fa-book',
                                'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                                'permissions' => json_encode(['view']),
                                'order' => 1,
                    ],
                    [
                                'name' => 'Preguntas Frecuentes',
                                'url' => str_replace(url('/'), '', route('help-faqs.index')),
                                'icon' => 'fas fa-info-circle',
                                'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                                'permissions' => json_encode(['view']),
                                'order' => 2,
                    ],
                            // [
                            //     'name' => 'Soporte Técnico',
                            //     'url' => str_replace(url('/'), '', route('help.support')),
                            //     'icon' => 'fas fa-headset',
                            //     'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                            //     'permissions' => json_encode(['create', 'view']),
                            //     'order' => 3,
                            // ],
                    [
                                'name' => 'Video Tutoriales',
                                'url' => str_replace(url('/'), '', route('help-videos.index')),
                                'icon' => 'fas fa-video',
                                'roles' => json_encode([$roleAdmin->id, $roleEditor->id, $roleUser->id]),
                                'permissions' => json_encode(['view']),
                                'order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Administrar Ayuda',
                'url' => '#',
                'icon' => 'fas fa-tools',
                'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                'permissions' => json_encode(['manage']),
                'order' => 4,
                'children' => [
                    [
                        'name' => 'Categorías de Ayuda',
                        'url' => str_replace(url('/'), '', route('help-categories.index')),
                        'icon' => 'fas fa-folder',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                        'permissions' => json_encode(['manage']),
                        'order' => 1,
                    ],
                    [
                        'name' => 'Guías',
                        'url' => str_replace(url('/'), '', route('help_guides.index')),
                        'icon' => 'fas fa-book-open',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                        'permissions' => json_encode(['manage']),
                        'order' => 2,
                    ],
                    [
                        'name' => 'FAQs',
                        'url' => str_replace(url('/'), '', route('help-faqs.index')),
                        'icon' => 'fas fa-question',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                        'permissions' => json_encode(['manage']),
                        'order' => 3,
                    ],
                    [
                        'name' => 'Videos de Ayuda',
                        'url' => str_replace(url('/'), '', route('help-videos.index')),
                        'icon' => 'fas fa-video',
                        'roles' => json_encode([$roleAdmin->id, $roleEditor->id]),
                        'permissions' => json_encode(['manage']),
                        'order' => 4,
                    ],
                ],
            ],
        ];

         
        foreach ($menus as $menu) {
            $menuModel = Menu::create([
                'name' => $menu['name'],
                'url' => $menu['url'],
                'icon' => $menu['icon'],
                'roles' => $menu['roles'],
                'permissions' => $menu['permissions'],
                'order' => $menu['order'],
            ]); 
             
            if (isset($menu['children'])) {
                foreach ($menu['children'] as $child) {
                    Menu::create([
                        'name' => $child['name'],
                        'url' => $child['url'],
                        'icon' => $child['icon'],
                        'roles' => $child['roles'],
                        'permissions' => $child['permissions'],
                        'order' => $child['order'],
                        'parent_id' => $menuModel->id,  
                    ]);
                }
            }
        }
    }
}
