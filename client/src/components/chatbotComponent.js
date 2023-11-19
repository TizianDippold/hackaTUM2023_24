import {Button} from "@material-tailwind/react";
import MessageComponentBot from "@/components/messageComponentBot";
import MessageComponentUser from "@/components/messageComponentUser";
import React, {useState} from 'react';
import {useRouter} from "next/router";
import Dictaphone from "@/components/Dictaphone";


export default function ChatbotComponent({sessionData}) {
    const {id, finalized} = sessionData || {};
    const [userInput, setUserInput] = useState('');
    const [chatList, chatSetList] = useState(['How can I help you today?']);
    const router = useRouter()

    const url = 'https://hackatum23.moremaier.com/api/chat-sessions';

    const textDetected = async (text) => {
        setUserInput(text);
        await handleButtonSend();
    };

    const fetchChatResponse = async () => {
        try {
            const response = await fetch(`${url}/${id}/messages`, {
                method: "POST",
                body: JSON.stringify({
                    message: userInput,
                }),
                headers: {
                    "Content-Type": "application/json; charset=UTF-8",
                    "Accept": "application/json",
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

    const fetchFinalizeResponse = async () => {
        try {
            const response = await fetch(`${url}/${id}/finalize`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json; charset=UTF-8",
                    "Accept": "application/json",
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };




    const handleInputChange = (e) => {
        setUserInput(e.target.value);
    };

    const handleButtonSend = async () => {
        if (userInput === '') {
            return;
        }
        chatSetList(prevState => prevState.concat(userInput));

        const responseData =  await fetchChatResponse(userInput);
        const botMsg = responseData['data']['content'];

        setUserInput('');
        chatSetList(prevState => prevState.concat(botMsg));

        console.log(responseData);
        if (responseData['data']['chat_session']['finalized']) {
            await router.push('/results');
        }
    };

    const handleButtonFinalize = async () => {
        const responseData = await fetchFinalizeResponse();
        if (responseData['data']['finalized']) {
            await router.push('/results');
        }
    }

    return (
        <>
            <div className="flex flex-col h-screen bg-gray-50">
                    <div className="flex justify-between bg-greenPastel p-4">
                        <img
                            src="https://img.hellofresh.com/f_auto,fl_lossy,q_auto/hellofresh_website/us/landing-pages/b2b/Hello_Fresh_White_Lockup_CMYK.png"
                            className="rounded-sm object-cover h-10 mt-2"/>
                    </div>
                    <div className="flex flex-col space-y-2 p-4">
                        <ul>
                            {chatList.map((element, index) => {
                                if (index % 2 === 0) {
                                    return <MessageComponentBot key={`bot-${index}`} textToDisplay={element} />;
                                } else {
                                    return <MessageComponentUser key={`user-${index}`} textToDisplay={element} />;
                                }
                            })}
                        </ul>
                    </div>
            </div>
            <div className="sticky items-center justify-end bg-gray-200 p-3 absolute bottom-0 w-screen">
                <div className="pl-2">
                    <input
                        type="text"
                        value={userInput}
                        onChange={handleInputChange}
                        placeholder="Food..."
                        className="bg-gray-200 pl-2 py-1 mr-3"
                    />

                    <Button onClick={handleButtonSend} className="bg-gray-200 p-0 shadow-none">
                        <img className="h-8 w-8 bg-gray-200" src="https://cdn.icon-icons.com/icons2/1509/PNG/512/mailsend_104372.png" alt="send"/>
                    </Button>
                    <Button onClick={handleButtonFinalize} className="bg-gray-200 p-0 shadow-none pl-3">
                        <img className="h-8 w-8 bg-gray-200" src="https://icones.pro/wp-content/uploads/2021/02/icone-de-tique-ronde-grise.png" alt="finalize"/>
                    </Button>
                    <Dictaphone textDetected={textDetected} />
                </div>
            </div>
        </>
    )
}