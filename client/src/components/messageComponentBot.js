
export default function MessageComponentBot(props) {

    const textToDisplay = props.textToDisplay;

    return(
        <div className="min-h-min-content min-w-min-content pr-[50px] bg-white flex-col justify-start items-start gap-2.5 flex">
            <div className="px-4 py-1.5 bg-zinc-400 rounded-[10px] justify-center items-center gap-2.5 inline-flex">
                <div className="text-white text-xs font-normal font-['Inter']">{textToDisplay}</div>
            </div>
        </div>

    )
}