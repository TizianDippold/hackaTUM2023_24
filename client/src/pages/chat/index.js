
import ChatbotComponent from "@/components/chatbotComponent";
import {useSession} from "@/pages/SessionContext";

export default function ChatBotPage({ children }) {
    const { sessionData } = useSession();

    return (
       <ChatbotComponent sessionData={sessionData}/>
    );
}

