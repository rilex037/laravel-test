export function parseJsonData<T>(data: string): T {
  try {
    const parsed = JSON.parse(data);
    if (parsed === null || typeof parsed === 'undefined') {
      return {} as T;
    }
    return parsed as T;
  } catch (error) {
    console.error('Error parsing JSON data:', error);
    return {} as T;
  }
}
