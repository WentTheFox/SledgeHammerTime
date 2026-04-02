import { AxiosError } from 'axios';

const MAX_RETRIES = 10;
const INITIAL_DELAY_MS = 1000;

export async function withExponentialBackoff<T>(fn: () => Promise<T>, label: string): Promise<T> {
  let attempt = 0;
  while (true) {
    try {
      return await fn();
    } catch (error) {
      const status = error instanceof AxiosError ? error.response?.status : undefined;
      if (status === 503 && attempt < MAX_RETRIES) {
        const delay = INITIAL_DELAY_MS * 2 ** attempt;
        console.warn(`${label}: received 503, retrying in ${delay}ms (attempt ${attempt + 1}/${MAX_RETRIES})…`);
        await new Promise((resolve) => setTimeout(resolve, delay));
        attempt++;
      } else if (error instanceof AxiosError) {
        const status = error.response?.status ?? 'unknown';
        const uri = error.config?.url ?? 'unknown';
        const body = error.response?.data !== undefined ? JSON.stringify(error.response.data) : undefined;
        const message = body ? `${label}: HTTP ${status} ${uri}\n${body}` : `${label}: HTTP ${status} ${uri}`;
        throw new Error(message);
      } else {
        throw error;
      }
    }
  }
}
