export function convertCentsToCurrency(cents: number): string {
  if (!cents && cents !== 0) return '';

  const euros = cents / 100;
  return euros.toLocaleString('de-DE', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  });
}

export function convertCurrencyToCents(currencyStr: string): number {
  if (!currencyStr) return 0;

  try {
    const normalized = currencyStr.replace(/€/g, '').replace(/\s/g, '').trim();

    const numericStr = normalized.replace(/\./g, '').replace(/,/g, '.');

    const euros = parseFloat(numericStr);
    if (isNaN(euros)) return 0;

    return Math.round(euros * 100);
  } catch (e) {
    console.error('Error converting currency to cents:', e);
    return 0;
  }
}
