import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'reverb',  // Use Reverb as the broadcaster
    key: import.meta.env.VITE_REVERB_APP_KEY,  // Reverb app key
    wsHost: import.meta.env.VITE_REVERB_HOST,  // Reverb WebSocket host
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,  // WebSocket port (default to 80)
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,  // Secure WebSocket port (default to 443)
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',  // Force TLS if scheme is https
    enabledTransports: ['ws', 'wss'],  // Enable WebSocket and Secure WebSocket
});
