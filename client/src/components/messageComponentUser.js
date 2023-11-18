export default function MessageComponentUser(props) {

    const textToDisplay = props.textToDisplay;

    return(
        <div className="flex justify-end">
            <div className="bg-green-400 text-white rounded-lg p-4 max-w-xs">
                <div className="text-white text-xs font-normal font-['Inter']">{textToDisplay}</div>
            </div>
        </div>
    )
}