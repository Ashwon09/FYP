@component('mail::message')
# Offer Received

{{$data['offer_from']}} made an offer for {{$data['game']}} game of {{$data['console']}} console

@component('mail::table')
|  |  |
| ------------- |:-------------:|
| Offer from | {{$data['offer_from']}} |
| Offer for | {{$data['game']}} of {{$data['console']}} |
| Cash Offer | Rs {{$data['offer']}} |
| Phone Number of {{$data['offer_from']}} | {{$data['phone']}} |
| Comment |{{$data['comment']}} |

@endcomponent

Thanks,<br>
@endcomponent
