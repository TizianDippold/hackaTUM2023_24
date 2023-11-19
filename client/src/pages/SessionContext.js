import React, { createContext, useContext, useState } from 'react';

const SessionContext = createContext();

export const SessionProvider = ({ children }) => {
    const [sessionData, setSessionData] = useState(null);

    const updateSessionData = (data) => {
        setSessionData(data);
    };

    return (
        <SessionContext.Provider value={{ sessionData, updateSessionData }}>
            {children}
        </SessionContext.Provider>
    );
};

export const useSession = () => {
    return useContext(SessionContext);
};
