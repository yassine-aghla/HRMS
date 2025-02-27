<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4">
            <div class="p-4 border-b">
                <h2 class="text-lg font-bold text-white">Dashboard</h2>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('emplois.index') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-blue-500 hover:text-white">
                             Gérer les emplois
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('formations.index') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-blue-500 hover:text-white">
                             Gérer les Formations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments.index') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-blue-500 hover:text-white">
                           Gérer les départements
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contrats.index') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-blue-500 hover:text-white">
                             Gérer les contrats
                        </a>
                    </li>
                    
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">statistiques</h2>

            <!-- Statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Emplois</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalEmplois ?? 0 }}</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Utilisateurs</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $totalUsers ?? 0 }}</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Départements</h3>
                    <p class="text-3xl font-bold text-orange-500">{{ $totalDepartments ?? 0 }}</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-600">Total Contrats</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $totalContrats ?? 0 }}</p>
                </div>
            </div>
        </main>
    </div>

