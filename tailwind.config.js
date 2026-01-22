/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      './resources/views/**/*.blade.php',
      './resources/css/**/*.css',
      './app/Filament/**/*.php', // Para que lea los archivos de Filament
  ],
  
  // Safelist: Obliga a Tailwind a generar estos estilos aunque no los detecte automáticamente
  safelist: [
      // Fondos
      'bg-gray-100',
      'bg-white',
      'bg-gray-50',
      'bg-green-100',
      'bg-blue-100',
      'bg-red-100',
      'bg-purple-100',
      'bg-yellow-100',
      'bg-indigo-100',
      'bg-rose-100',
      'bg-gray-200',
      
      // Bordes
      'border-green-500',
      'border-blue-500',
      'border-red-500',
      'border-purple-500',
      'border-yellow-500',
      'border-gray-600',
      'border-indigo-500',
      'border-rose-500',
      'border-gray-200',
      
      // Sombras y Formas
      'shadow-xl',
      'shadow-lg',
      'shadow-2xl',
      'rounded-xl',
      'rounded-full',
      
      // Grid y Espaciado
      'grid-cols-1',
      'grid-cols-3',
      'gap-6',
      'gap-4',
      
      // Alturas
      'min-h-screen',
      'h-[140px]',
  ],
}