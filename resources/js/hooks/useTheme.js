import { useEffect, useState } from 'react';

export default function useTheme() {
  const [theme, setTheme] = useState('light');

  useEffect(() => {
    const savedTheme = localStorage.getItem('theme');

    if (savedTheme === 'dark') {
      document.documentElement.classList.add('dark');
      setTheme('dark');
    }
  }, []);

  function toggleTheme() {
    const isDark = document.documentElement.classList.contains('dark');

    if (isDark) {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
      setTheme('light');
    } else {
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
      setTheme('dark');
    }
  }

  return {
    theme,
    toggleTheme,
  };
}
