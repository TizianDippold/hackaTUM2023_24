// pages/SessionContext.js
import { createContext, useContext, useState } from 'react';

const SessionContext = createContext();

export const SessionProvider = ({ children }) => {
    const [sessionData, setSessionData] = useState(null);

    return (
        <SessionContext.Provider value={{ sessionData, setSessionData }}>
            {children}
        </SessionContext.Provider>
    );
};

export const useSession = () => {
    return useContext(SessionContext);
};
