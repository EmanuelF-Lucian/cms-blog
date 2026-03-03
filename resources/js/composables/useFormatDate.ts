export function useFormatDate() {
    const format = (date: string | null | undefined): string => {
        if (!date) return '';
        return new Intl.DateTimeFormat('en-US', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
        }).format(new Date(date));
    };

    return { format };
}
