import { describe, expect, it } from 'vitest';
import { parseIndonesianAmount } from './indonesianNumberParser';

describe('parseIndonesianAmount', () => {
    it('parses required voice amount examples', () => {
        const cases = [
            ['500 ribu', 500_000],
            ['250 ribu', 250_000],
            ['1 juta', 1_000_000],
            ['5 juta', 5_000_000],
            ['1,5 juta', 1_500_000],
            ['3.5 juta', 3_500_000],
            ['2 miliar', 2_000_000_000],
            ['1.25 miliar', 1_250_000_000],
            ['1 triliun', 1_000_000_000_000],
            ['75000', 75_000],
        ];

        cases.forEach(([input, expected]) => {
            expect(parseIndonesianAmount(input)).toBe(expected);
        });
    });

    it('parses full transaction sentences', () => {
        expect(parseIndonesianAmount('bayar kontrakan 1,5 juta')).toBe(1_500_000);
        expect(parseIndonesianAmount('terima gaji lima juta')).toBe(5_000_000);
        expect(parseIndonesianAmount('beli makan dua puluh lima ribu')).toBe(25_000);
        expect(parseIndonesianAmount('dapat bonus dua juta lima ratus ribu')).toBe(2_500_000);
    });

    it('parses formatted numeric amounts without scale words', () => {
        expect(parseIndonesianAmount('25.000')).toBe(25_000);
        expect(parseIndonesianAmount('25,000')).toBe(25_000);
        expect(parseIndonesianAmount('1.250.000')).toBe(1_250_000);
        expect(parseIndonesianAmount('1,250,000')).toBe(1_250_000);
    });

    it('returns null when there is no valid amount', () => {
        expect(parseIndonesianAmount('')).toBeNull();
        expect(parseIndonesianAmount('beli makan siang')).toBeNull();
        expect(parseIndonesianAmount(null)).toBeNull();
    });
});
