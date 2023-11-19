
import ChatbotComponent from "@/components/chatbotComponent";
import {useSession} from "@/pages/SessionContext";

export default function ChatBotPage({ children }) {
    const { sessionData } = useSession();
    console.log("chat index");
    console.log(sessionData);
    return (
       <ChatbotComponent sessionData={sessionData}/>
    );
}

