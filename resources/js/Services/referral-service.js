export const referralList = async () => {
    try {
        const apiUrl = '/referral/list';
        const response = await fetch(apiUrl); 
        return response.json();
    } catch {
        throw new Error('Could not fetch referral list.')
    }
};

export const sendReferral = async (body) => {
    try {
        const apiUrl = '/referral';
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
            },
            body: JSON.stringify(body)
        }); 
        return response.json();
    } catch {
        throw new Error('Failed to send the referral request.')
    }
};