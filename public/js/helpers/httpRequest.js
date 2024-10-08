const httpRequest = async (url, method = 'GET', data = null, headers = {}) => {
    try {
        // Configuración base del fetch
        const options = {
            method,
            headers: {
                'Content-Type': 'application/json',
                ...headers, // Sobrescribe los headers por si pasas alguno personalizado
            },
        };

        // Si es una petición POST, agrega el cuerpo con los datos en formato JSON
        if (method === 'POST' && data) {
            options.body = JSON.stringify(data);
        }

        // Realiza la petición
        const response = await fetch(url, options);

        // Si la respuesta es 202, no se espera un cuerpo, pero retornamos un mensaje predeterminado
        if (response.status === 202) {
            return {
                status: 202,
                message: 'Request accepted, processing in progress',
                error: false,
                data: null // No se devuelve ningún cuerpo en 202
            };
        }

        // Para otras respuestas, intentamos parsear el JSON
        const result = await response.json();

        // Verifica si la respuesta del servidor contiene algún campo de error
        if (!response.ok || result.error) {
            return {
                status: response.status,
                message: result.error || `Error: ${response.statusText}`,
                error: true,
                data: result
            };
        }

        return {
            status: response.status,
            message: 'Request successful',
            error: false,
            data: result
        };

    } catch (error) {
        // Manejo de errores de red o parsing
        return {
            status: 500,
            message: 'Network or server error',
            error: true,
            data: null,
            errorDetail: error.message // Incluimos el mensaje del error en detalle
        };
    }
};

export default httpRequest;
